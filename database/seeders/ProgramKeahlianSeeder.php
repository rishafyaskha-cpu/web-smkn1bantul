<?php

namespace Database\Seeders;

use App\Models\ProgramKeahlian;
use Illuminate\Database\Seeder;

class ProgramKeahlianSeeder extends Seeder
{
    /**
     * Kategori dan ringkasan ringkas untuk kartu program keahlian.
     */
    private array $meta = [
        'akutansi-dan-lembaga-keuangan' => [
            'category' => 'Bisnis',
            'summary' => 'Praktik perbankan pada Mini Bank Sekolah, Komputer Akuntansi MYOB/Accurate, perpajakan, dan sertifikasi BNSP.',
        ],
        'layanan-perbankan-syariah' => [
            'category' => 'Bisnis',
            'summary' => 'Operasional perbankan syariah, layanan nasabah, administrasi transaksi, dan pengelolaan keuangan.',
        ],
        'pemasaran' => [
            'category' => 'Bisnis',
            'summary' => 'Pengelolaan toko, pelayanan pelanggan, strategi penjualan, dan penataan produk.',
        ],
        'manajemen-perkantoran-dan-layanan-bisnis' => [
            'category' => 'Manajemen',
            'summary' => 'Tata kelola perkantoran modern, administrasi digital, kesekretariatan bisnis, dan layanan relations.',
        ],
        'desain-komunikasi-visual' => [
            'category' => 'Seni & Kreatif',
            'summary' => 'Karya animasi 2D/3D, ilustrasi digital, branding korporat, sinematografi, dan studio broadcaster.',
        ],
        'rekayasa-perangkat-lunak' => [
            'category' => 'TIK',
            'summary' => 'Pengembangan web dan aplikasi mobile, UI/UX design, database cloud, serta praktik langsung.',
        ],
        'teknik-komputer-dan-jaringan' => [
            'category' => 'TIK',
            'summary' => 'Perakitan komputer, jaringan dasar, konfigurasi perangkat, serta sistem dan keamanan jaringan.',
        ],
    ];

    public function run(): void
    {
        $path = database_path('data/programs.json');

        $items = json_decode(file_get_contents($path), true, 512, JSON_THROW_ON_ERROR);

        foreach ($items as $index => $item) {
            $meta = $this->meta[$item['id']] ?? ['category' => 'Lainnya', 'summary' => null];

            ProgramKeahlian::updateOrCreate(
                ['slug' => $item['id']],
                [
                    'title' => $item['content']['title'],
                    'category' => $meta['category'],
                    'image' => ltrim($item['content']['images'] ?? '', '/'),
                    'summary' => $meta['summary'],
                    'sections' => $item['content']['sections'] ?? [],
                    'is_published' => true,
                    'sort_order' => $index + 1,
                ]
            );
        }
    }
}
