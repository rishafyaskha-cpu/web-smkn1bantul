<?php

namespace Tests\Feature;

use App\Models\Article;
use App\Models\ProgramKeahlian;
use App\Models\SaranaPrasarana;
use Database\Seeders\ProgramKeahlianSeeder;
use Database\Seeders\SaranaPrasaranaSeeder;
use Database\Seeders\SiteContentSeeder;
use Database\Seeders\SiteSettingSeeder;
use Illuminate\Foundation\Testing\LazilyRefreshDatabase;
use PHPUnit\Framework\Attributes\DataProvider;
use Tests\TestCase;

class PublicPagesTest extends TestCase
{
    use LazilyRefreshDatabase;

    private function seedSite(): void
    {
        $this->seed([
            SiteSettingSeeder::class,
            ProgramKeahlianSeeder::class,
            SaranaPrasaranaSeeder::class,
            SiteContentSeeder::class,
        ]);
    }

    /**
     * @return array<string, array{string}>
     */
    public static function staticPages(): array
    {
        return [
            'home' => ['home'],
            'sejarah' => ['sejarah'],
            'visi-misi' => ['visi-misi'],
            'struktur-organisasi' => ['struktur-organisasi'],
            'sarana-prasarana' => ['sarana-prasarana.index'],
            'program-keahlian' => ['program-keahlian.index'],
            'berita' => ['berita.index'],
            'prestasi' => ['prestasi'],
            'ekstrakurikuler' => ['ekstrakurikuler'],
            'organisasi-siswa' => ['organisasi-siswa'],
            'teaching-factory' => ['teaching-factory'],
            'ppdb' => ['ppdb'],
        ];
    }

    #[DataProvider('staticPages')]
    public function test_public_page_renders_with_site_content(string $routeName): void
    {
        $this->seedSite();

        $this->get(route($routeName))->assertOk();
    }

    public function test_home_page_shows_principal_message_from_settings(): void
    {
        $this->seedSite();

        $this->get(route('home'))
            ->assertOk()
            ->assertSee('Assalamualaikum warahmatullahi wabarakatuh', false);
    }

    public function test_program_keahlian_detail_renders_for_published_program(): void
    {
        $this->seedSite();

        $program = ProgramKeahlian::published()->firstOrFail();

        $this->get(route('program-keahlian.show', $program))->assertOk();
    }

    public function test_sarana_prasarana_detail_renders_for_published_item(): void
    {
        $this->seedSite();

        $sarana = SaranaPrasarana::published()->firstOrFail();

        $this->get(route('sarana-prasarana.show', $sarana))->assertOk();
    }

    public function test_berita_detail_renders_for_published_article(): void
    {
        $article = Article::factory()->create(['title' => 'Juara LKS Nasional']);

        $this->get(route('berita.show', $article))
            ->assertOk()
            ->assertSee('Juara LKS Nasional');
    }

    public function test_berita_detail_returns_404_for_unpublished_article(): void
    {
        $article = Article::factory()->unpublished()->create();

        $this->get(route('berita.show', $article))->assertNotFound();
    }

    public function test_berita_index_filters_articles_by_search_term(): void
    {
        Article::factory()->create(['title' => 'Prestasi Robotik Siswa']);
        Article::factory()->create(['title' => 'Jadwal Ujian Sekolah']);

        $this->get(route('berita.index', ['q' => 'Robotik']))
            ->assertOk()
            ->assertSee('Prestasi Robotik Siswa')
            ->assertDontSee('Jadwal Ujian Sekolah');
    }

    public function test_berita_index_does_not_list_unpublished_articles(): void
    {
        Article::factory()->create(['title' => 'Berita Terbit']);
        Article::factory()->unpublished()->create(['title' => 'Berita Arsip']);

        $this->get(route('berita.index'))
            ->assertOk()
            ->assertSee('Berita Terbit')
            ->assertDontSee('Berita Arsip');
    }

    public function test_sitemap_lists_published_content_as_xml(): void
    {
        $this->seedSite();

        $program = ProgramKeahlian::published()->firstOrFail();

        $this->get(route('sitemap'))
            ->assertOk()
            ->assertHeader('Content-Type', 'application/xml')
            ->assertSee(route('program-keahlian.show', $program), false);
    }

    public function test_robots_disallows_admin_and_links_sitemap(): void
    {
        $this->get(route('robots'))
            ->assertOk()
            ->assertHeader('Content-Type', 'text/plain; charset=UTF-8')
            ->assertSee('Disallow: /admin')
            ->assertSee('Sitemap: '.route('sitemap'));
    }
}
