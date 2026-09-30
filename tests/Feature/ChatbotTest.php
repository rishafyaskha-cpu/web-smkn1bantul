<?php

namespace Tests\Feature;

use App\Models\ProgramKeahlian;
use App\Models\SaranaPrasarana;
use App\Support\SchoolKnowledgeBase;
use Illuminate\Foundation\Testing\LazilyRefreshDatabase;
use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\Http;
use Tests\TestCase;

class ChatbotTest extends TestCase
{
    use LazilyRefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        config()->set('services.gemini.key', 'test-gemini-key');
        config()->set('services.gemini.model', 'gemini-2.5-flash');
        config()->set('services.gemini.base_url', 'https://generativelanguage.googleapis.com/v1beta');
        config()->set('services.chatbot.enabled', true);
        config()->set('services.chatbot.max_question_length', 500);
        config()->set('services.chatbot.max_history_messages', 10);
        config()->set('services.chatbot.max_history_content_length', 2000);
        config()->set('services.chatbot.per_ip_per_minute', 10);
        config()->set('services.chatbot.per_ip_daily_limit', 30);
        config()->set('services.chatbot.global_daily_limit', 300);
    }

    private function fakeGeminiAnswer(string $answer): void
    {
        Http::fake([
            'generativelanguage.googleapis.com/*' => Http::response([
                'candidates' => [
                    [
                        'content' => [
                            'parts' => [['text' => $answer]],
                        ],
                    ],
                ],
            ]),
        ]);
    }

    public function test_chatbot_endpoint_returns_answer_from_gemini(): void
    {
        $this->fakeGeminiAnswer('SMKN 1 Bantul memiliki 7 program keahlian.');

        $this->postJson(route('chatbot.ask'), ['message' => 'Ada berapa jurusan?'])
            ->assertOk()
            ->assertJson(['answer' => 'SMKN 1 Bantul memiliki 7 program keahlian.']);
    }

    public function test_chatbot_sends_api_key_header_and_model_endpoint(): void
    {
        $this->fakeGeminiAnswer('Baik.');

        $this->postJson(route('chatbot.ask'), ['message' => 'Halo'])->assertOk();

        Http::assertSent(function (Request $request): bool {
            return $request->hasHeader('x-goog-api-key', 'test-gemini-key')
                && str_contains($request->url(), '/models/gemini-2.5-flash:generateContent');
        });
    }

    public function test_chatbot_includes_school_data_in_system_instruction(): void
    {
        ProgramKeahlian::create([
            'slug' => 'rekayasa-perangkat-lunak',
            'title' => 'Rekayasa Perangkat Lunak',
            'category' => 'TIK',
            'summary' => 'Belajar membuat aplikasi web dan mobile.',
            'sections' => [],
            'is_published' => true,
            'sort_order' => 1,
        ]);

        SaranaPrasarana::create([
            'slug' => 'perpustakaan',
            'title' => 'Perpustakaan',
            'description' => 'Tempat membaca yang nyaman.',
            'is_published' => true,
            'sort_order' => 1,
        ]);

        app(SchoolKnowledgeBase::class)->flush();

        $this->fakeGeminiAnswer('Baik.');

        $this->postJson(route('chatbot.ask'), ['message' => 'Apa saja jurusan?'])->assertOk();

        Http::assertSent(function (Request $request): bool {
            $instruction = $request['systemInstruction']['parts'][0]['text'] ?? '';

            return str_contains($instruction, 'Rekayasa Perangkat Lunak')
                && str_contains($instruction, 'Perpustakaan');
        });
    }

    public function test_chatbot_forwards_previous_conversation_to_gemini(): void
    {
        $this->fakeGeminiAnswer('Baik.');

        $this->postJson(route('chatbot.ask'), [
            'message' => 'Kalau yang itu?',
            'history' => [
                ['role' => 'user', 'content' => 'Apa itu PPDB?'],
                ['role' => 'assistant', 'content' => 'PPDB adalah penerimaan peserta didik baru.'],
            ],
        ])->assertOk();

        Http::assertSent(function (Request $request): bool {
            $contents = $request['contents'] ?? [];

            return count($contents) === 3
                && $contents[0]['role'] === 'user'
                && $contents[1]['role'] === 'model'
                && $contents[2]['parts'][0]['text'] === 'Kalau yang itu?';
        });
    }

    public function test_chatbot_accepts_long_assistant_history(): void
    {
        $this->fakeGeminiAnswer('Baik.');

        $this->postJson(route('chatbot.ask'), [
            'message' => 'Lanjutkan',
            'history' => [
                ['role' => 'assistant', 'content' => str_repeat('a', 1500)],
            ],
        ])->assertOk();
    }

    public function test_chatbot_requires_a_message(): void
    {
        Http::fake();

        $this->postJson(route('chatbot.ask'), ['message' => ''])
            ->assertUnprocessable()
            ->assertJsonValidationErrors('message');

        Http::assertNothingSent();
    }

    public function test_chatbot_rejects_message_longer_than_limit(): void
    {
        Http::fake();

        $this->postJson(route('chatbot.ask'), ['message' => str_repeat('a', 501)])
            ->assertUnprocessable()
            ->assertJsonValidationErrors('message');

        Http::assertNothingSent();
    }

    public function test_chatbot_rejects_requests_after_per_ip_daily_limit(): void
    {
        config()->set('services.chatbot.per_ip_daily_limit', 2);
        config()->set('services.chatbot.per_ip_per_minute', 100);

        $this->fakeGeminiAnswer('Baik.');

        $this->postJson(route('chatbot.ask'), ['message' => 'Halo'])->assertOk();
        $this->postJson(route('chatbot.ask'), ['message' => 'Halo lagi'])->assertOk();

        $this->postJson(route('chatbot.ask'), ['message' => 'Halo ketiga'])
            ->assertStatus(503)
            ->assertJson(['error' => 'Batas harian pertanyaan Anda telah tercapai. Silakan coba lagi besok.']);
    }

    public function test_chatbot_rejects_requests_after_global_daily_limit(): void
    {
        config()->set('services.chatbot.global_daily_limit', 1);
        config()->set('services.chatbot.per_ip_per_minute', 100);

        $this->fakeGeminiAnswer('Baik.');

        $this->postJson(route('chatbot.ask'), ['message' => 'Halo'])->assertOk();

        $this->postJson(route('chatbot.ask'), ['message' => 'Halo lagi'])
            ->assertStatus(503)
            ->assertJson(['error' => 'Kuota harian layanan chatbot telah tercapai. Silakan coba lagi besok.']);
    }

    public function test_chatbot_usage_is_not_recorded_when_gemini_fails(): void
    {
        config()->set('services.chatbot.per_ip_daily_limit', 1);
        config()->set('services.chatbot.per_ip_per_minute', 100);

        Http::fakeSequence('generativelanguage.googleapis.com/*')
            ->push(['error' => ['message' => 'boom']], 500)
            ->push([
                'candidates' => [
                    [
                        'content' => [
                            'parts' => [['text' => 'Baik.']],
                        ],
                    ],
                ],
            ]);

        $this->postJson(route('chatbot.ask'), ['message' => 'Halo'])->assertStatus(503);

        $this->postJson(route('chatbot.ask'), ['message' => 'Halo lagi'])->assertOk();
    }

    public function test_chatbot_returns_service_unavailable_when_api_key_missing(): void
    {
        config()->set('services.gemini.key', null);

        Http::fake();

        $this->postJson(route('chatbot.ask'), ['message' => 'Halo'])
            ->assertStatus(503)
            ->assertJsonStructure(['error']);

        Http::assertNothingSent();
    }

    public function test_chatbot_returns_service_unavailable_when_disabled(): void
    {
        config()->set('services.chatbot.enabled', false);

        Http::fake();

        $this->postJson(route('chatbot.ask'), ['message' => 'Halo'])
            ->assertStatus(503);

        Http::assertNothingSent();
    }

    public function test_chatbot_handles_gemini_error_response(): void
    {
        Http::fake([
            'generativelanguage.googleapis.com/*' => Http::response(['error' => ['message' => 'quota']], 429),
        ]);

        $this->postJson(route('chatbot.ask'), ['message' => 'Halo'])
            ->assertStatus(503)
            ->assertJsonStructure(['error']);
    }

    public function test_chatbot_handles_gemini_empty_candidate_response(): void
    {
        Http::fake([
            'generativelanguage.googleapis.com/*' => Http::response(['candidates' => []]),
        ]);

        $this->postJson(route('chatbot.ask'), ['message' => 'Halo'])
            ->assertStatus(503)
            ->assertJsonStructure(['error']);
    }

    public function test_chatbot_does_not_leak_api_key_in_response(): void
    {
        $this->fakeGeminiAnswer('Baik.');

        $response = $this->postJson(route('chatbot.ask'), ['message' => 'Halo'])->assertOk();

        $this->assertStringNotContainsString('test-gemini-key', $response->getContent());
    }

    public function test_home_page_renders_chatbot_widget(): void
    {
        $this->get(route('home'))
            ->assertOk()
            ->assertSee('Skansaba AI')
            ->assertSee('Tanya Skansaba AI')
            ->assertSee('chatbot({', false);
    }

    public function test_chatbot_widget_renders_suggestion_chips_with_labels(): void
    {
        $this->get(route('home'))
            ->assertOk()
            ->assertSee('Pertanyaan populer')
            ->assertSee('suggestion-chip', false)
            ->assertSee('iconPaths', false);
    }

    public function test_chatbot_suggestions_are_tailored_to_the_current_page(): void
    {
        $this->get(route('ppdb'))
            ->assertOk()
            ->assertSee('Apa syarat mendaftar PPDB?')
            ->assertSee('Informasi PPDB')
            ->assertDontSee('Apa saja fasilitas di sekolah ini?');
    }

    public function test_knowledge_base_includes_site_navigation_links(): void
    {
        $knowledge = app(SchoolKnowledgeBase::class)->build();

        $this->assertStringContainsString('== PETA HALAMAN WEBSITE', $knowledge);
        $this->assertStringContainsString(route('ppdb'), $knowledge);
        $this->assertStringContainsString(route('program-keahlian.index'), $knowledge);
    }

    public function test_knowledge_base_includes_program_detail_and_page_links(): void
    {
        $program = ProgramKeahlian::create([
            'slug' => 'teknik-komputer-jaringan',
            'title' => 'Teknik Komputer dan Jaringan',
            'category' => 'TIK',
            'summary' => 'Belajar jaringan komputer.',
            'sections' => [
                ['type' => 'paragraph', 'text' => 'Mempelajari instalasi jaringan fiber optic.'],
            ],
            'is_published' => true,
            'sort_order' => 1,
        ]);

        app(SchoolKnowledgeBase::class)->flush();

        $knowledge = app(SchoolKnowledgeBase::class)->build();

        $this->assertStringContainsString('Teknik Komputer dan Jaringan', $knowledge);
        $this->assertStringContainsString('instalasi jaringan fiber optic', $knowledge);
        $this->assertStringContainsString(route('program-keahlian.show', $program), $knowledge);
    }

    public function test_knowledge_base_excludes_unpublished_content(): void
    {
        ProgramKeahlian::create([
            'slug' => 'jurusan-rahasia',
            'title' => 'Jurusan Rahasia',
            'summary' => 'Belum boleh dipublikasikan.',
            'sections' => [],
            'is_published' => false,
            'sort_order' => 1,
        ]);

        app(SchoolKnowledgeBase::class)->flush();

        $this->assertStringNotContainsString('Jurusan Rahasia', app(SchoolKnowledgeBase::class)->build());
    }

    public function test_system_instruction_tells_bot_to_share_page_links(): void
    {
        $this->fakeGeminiAnswer('Baik.');

        $this->postJson(route('chatbot.ask'), ['message' => 'Apa saja jurusan?'])->assertOk();

        Http::assertSent(function (Request $request): bool {
            $instruction = $request['systemInstruction']['parts'][0]['text'] ?? '';

            return str_contains($instruction, 'PETA HALAMAN WEBSITE')
                && str_contains($instruction, 'tautan halaman website');
        });
    }

    public function test_chatbot_widget_is_hidden_when_disabled(): void
    {
        config()->set('services.chatbot.enabled', false);

        $this->get(route('home'))
            ->assertOk()
            ->assertDontSee('Skansaba AI');
    }

    public function test_home_page_no_longer_loads_sienna_accessibility_script(): void
    {
        $this->get(route('home'))
            ->assertOk()
            ->assertDontSee('sienna-accessibility');
    }
}
