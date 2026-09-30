<?php

namespace Tests\Feature;

use App\Models\Article;
use App\Models\ProgramKeahlian;
use App\Models\SaranaPrasarana;
use Database\Seeders\ArticleSeeder;
use Database\Seeders\DownloadSeeder;
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
            ArticleSeeder::class,
            DownloadSeeder::class,
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
            'download' => ['download'],
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

    public function test_navbar_lists_all_eight_programs_in_requested_order(): void
    {
        $this->seedSite();

        $expectedSlugs = [
            'rekayasa-perangkat-lunak',
            'teknik-komputer-dan-jaringan',
            'desain-komunikasi-visual',
            'akutansi-dan-lembaga-keuangan',
            'layanan-perbankan-syariah',
            'manajemen-perkantoran-dan-layanan-bisnis',
            'bisnis-ritel',
            'bisnis-digital',
        ];

        $this->assertSame(8, ProgramKeahlian::published()->count());

        $this->get(route('home'))
            ->assertOk()
            ->assertSeeInOrder(
                array_map(fn (string $slug): string => route('program-keahlian.show', $slug), $expectedSlugs),
                false
            );
    }

    public function test_ppdb_program_cards_link_to_their_own_program_page(): void
    {
        $this->seedSite();

        $this->get(route('ppdb'))
            ->assertOk()
            ->assertSeeInOrder([
                'Pengelolaan toko, pelayanan pelanggan, strategi penjualan, penataan produk',
                route('program-keahlian.show', 'bisnis-ritel'),
            ], false)
            ->assertSeeInOrder([
                'Digital marketing, e-commerce, pengelolaan konten, strategi bisnis online',
                route('program-keahlian.show', 'bisnis-digital'),
            ], false);
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

    public function test_berita_index_lists_seeded_articles_newest_first(): void
    {
        $this->seedSite();

        $this->assertSame(15, Article::published()->count());

        $this->get(route('berita.index'))
            ->assertOk()
            ->assertSeeInOrder([
                'SMKN 1 Bantul Perkuat Kemitraan Industri',
                'SNBP 2026',
                'Prestasi LKS 2026',
            ]);
    }

    public function test_berita_detail_renders_seeded_article_with_image(): void
    {
        $this->seedSite();

        $article = Article::where('slug', 'prestasi-lks-2026')->firstOrFail();

        $this->get(route('berita.show', $article))
            ->assertOk()
            ->assertSee('Ilyas Giyan Swandaru')
            ->assertSee('images/berita/01KRD6DDVXY3G50NWN91E40WKQ.png', false);
    }

    public function test_download_page_lists_seeded_files(): void
    {
        $this->seedSite();

        $this->get(route('download'))
            ->assertOk()
            ->assertSee('Akreditasi Sekolah')
            ->assertSee('Pengumuman Eligible Seleksi SNBP Tahun 2026')
            ->assertSee('downloads/01KEXC79ASQ42X6NAWJA33Y6N6.pdf', false);
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
