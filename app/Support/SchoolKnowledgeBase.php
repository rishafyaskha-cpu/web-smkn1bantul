<?php

namespace App\Support;

use App\Models\Achievement;
use App\Models\Article;
use App\Models\Download;
use App\Models\Ekstrakurikuler;
use App\Models\OrganisasiSiswa;
use App\Models\PpdbProgram;
use App\Models\PpdbStep;
use App\Models\ProgramKeahlian;
use App\Models\SaranaPrasarana;
use App\Models\SiteStatistic;
use App\Models\TeachingFactory;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Str;

class SchoolKnowledgeBase
{
    public const CACHE_KEY = 'chatbot.knowledge_base';

    public const CACHE_TTL_SECONDS = 3600;

    public function build(): string
    {
        return Cache::remember(self::CACHE_KEY, self::CACHE_TTL_SECONDS, fn (): string => $this->compose());
    }

    public function flush(): void
    {
        Cache::forget(self::CACHE_KEY);
    }

    private function compose(): string
    {
        $sections = array_filter([
            $this->schoolProfile(),
            $this->statistics(),
            $this->programs(),
            $this->facilities(),
            $this->extracurriculars(),
            $this->studentOrganizations(),
            $this->teachingFactories(),
            $this->achievements(),
            $this->ppdb(),
            $this->news(),
            $this->downloads(),
            $this->siteNavigation(),
        ]);

        return implode("\n\n", $sections);
    }

    private function schoolProfile(): string
    {
        $lines = [
            'NAMA SEKOLAH: '.Site::name(),
            'NAMA SINGKAT: '.Site::shortName(),
        ];

        if ($address = Site::address()) {
            $lines[] = 'ALAMAT: '.$address;
        }

        if ($phone = Site::phone()) {
            $lines[] = 'TELEPON: '.$phone;
        }

        if ($email = Site::get('contact.email')) {
            $lines[] = 'EMAIL: '.$email;
        }

        if ($tagline = Site::get('school.tagline_short')) {
            $lines[] = 'SLOGAN: '.$tagline;
        }

        if ($vision = Site::get('vision.points')) {
            $lines[] = 'VISI: '.$this->plainText($vision);
        }

        if ($mission = Site::get('mission.points')) {
            $lines[] = 'MISI: '.$this->plainText($mission);
        }

        if ($principal = Site::principal()) {
            $lines[] = 'KEPALA SEKOLAH: '.$principal['name'];
        }

        if ($history = Site::get('history.body')) {
            $lines[] = 'SEJARAH SINGKAT: '.Str::limit($this->plainText($history), 1200);
        }

        $socials = collect([
            'YouTube' => Site::get('social.youtube'),
            'Instagram' => Site::get('social.instagram'),
            'X' => Site::get('social.x'),
            'Telegram' => Site::get('social.telegram'),
            'TikTok' => Site::get('social.tiktok'),
        ])->filter();

        if ($socials->isNotEmpty()) {
            $lines[] = 'MEDIA SOSIAL RESMI: '.$socials->map(fn ($url, $name): string => "{$name} ({$url})")->implode(', ');
        }

        return "== PROFIL SEKOLAH ==\n".implode("\n", $lines);
    }

    private function statistics(): string
    {
        $items = SiteStatistic::ordered()->get();

        if ($items->isEmpty()) {
            return '';
        }

        $lines = $items->map(fn (SiteStatistic $item): string => "- {$item->label}: {$item->value}")->all();

        return "== DATA STATISTIK SEKOLAH ==\n".implode("\n", $lines);
    }

    private function programs(): string
    {
        $programs = ProgramKeahlian::published()->ordered()->get();

        if ($programs->isEmpty()) {
            return '';
        }

        $lines = $programs->map(function (ProgramKeahlian $program): string {
            $parts = ["- {$program->title}"];

            if ($program->category) {
                $parts[] = "(bidang: {$program->category})";
            }

            if ($program->summary) {
                $parts[] = $program->summary;
            }

            $parts[] = 'Halaman: '.route('program-keahlian.show', $program->slug);

            $detail = $this->sectionsText($program->sections ?? []);

            if ($detail !== '') {
                $parts[] = 'Detail: '.Str::limit($detail, 600);
            }

            return implode(' ', $parts);
        })->all();

        return "== PROGRAM KEAHLIAN (JURUSAN) ==\n".implode("\n", $lines);
    }

    private function facilities(): string
    {
        $items = SaranaPrasarana::published()->ordered()->get();

        if ($items->isEmpty()) {
            return '';
        }

        $lines = $items->map(function (SaranaPrasarana $item): string {
            $line = $item->description
                ? "- {$item->title}: ".Str::limit($this->plainText($item->description), 400)
                : "- {$item->title}";

            return $line.' (halaman: '.route('sarana-prasarana.show', $item->slug).')';
        })->all();

        return "== SARANA DAN PRASARANA ==\n".implode("\n", $lines);
    }

    private function extracurriculars(): string
    {
        $items = Ekstrakurikuler::published()->ordered()->get();

        if ($items->isEmpty()) {
            return '';
        }

        $lines = $items->map(function (Ekstrakurikuler $item): string {
            return $item->description
                ? "- {$item->name}: ".Str::limit($this->plainText($item->description), 200)
                : "- {$item->name}";
        })->all();

        return "== EKSTRAKURIKULER ==\n".implode("\n", $lines);
    }

    private function studentOrganizations(): string
    {
        $items = OrganisasiSiswa::published()->ordered()->get();

        if ($items->isEmpty()) {
            return '';
        }

        $lines = $items->map(function (OrganisasiSiswa $item): string {
            return $item->description
                ? "- {$item->name}: ".Str::limit($this->plainText($item->description), 200)
                : "- {$item->name}";
        })->all();

        return "== ORGANISASI SISWA ==\n".implode("\n", $lines);
    }

    private function teachingFactories(): string
    {
        $items = TeachingFactory::published()->ordered()->with('programKeahlian')->get();

        if ($items->isEmpty()) {
            return '';
        }

        $lines = $items->map(function (TeachingFactory $item): string {
            $line = $item->partner_name
                ? "- {$item->title} bekerja sama dengan {$item->partner_name}"
                : "- {$item->title}";

            if ($item->programKeahlian) {
                $line .= " (program: {$item->programKeahlian->title})";
            }

            if ($item->description) {
                $line .= '. '.Str::limit($this->plainText($item->description), 300);
            }

            return $line;
        })->all();

        return "== TEACHING FACTORY (KEMITRAAN INDUSTRI) ==\n".implode("\n", $lines);
    }

    private function achievements(): string
    {
        $items = Achievement::published()->ordered()->limit(20)->get();

        if ($items->isEmpty()) {
            return '';
        }

        $lines = $items->map(function (Achievement $item): string {
            $line = "- {$item->description}";

            if ($item->student_name) {
                $line .= " (oleh {$item->student_name}";

                if ($item->class_name) {
                    $line .= ", kelas {$item->class_name}";
                }

                $line .= ')';
            }

            if ($item->level) {
                $line .= " [tingkat {$item->level}]";
            }

            if ($item->achieved_at) {
                $line .= ' ['.$item->achieved_at->translatedFormat('F Y').']';
            }

            return $line;
        })->all();

        return "== PRESTASI SISWA ==\n".implode("\n", $lines);
    }

    private function ppdb(): string
    {
        $steps = PpdbStep::ordered()->get();
        $programs = PpdbProgram::published()->ordered()->get();
        $lines = [];

        if ($steps->isNotEmpty()) {
            $lines[] = 'ALUR PENDAFTARAN:';

            foreach ($steps as $index => $step) {
                $number = $index + 1;
                $lines[] = $step->description
                    ? "{$number}. {$step->title}: ".$this->plainText($step->description)
                    : "{$number}. {$step->title}";
            }
        }

        if ($programs->isNotEmpty()) {
            $lines[] = 'PROGRAM YANG DIBUKA SAAT PPDB:';
            $lines[] = $programs->map(fn (PpdbProgram $program): string => "- {$program->title} ({$program->category})".($program->description ? ': '.Str::limit($this->plainText($program->description), 200) : ''))->implode("\n");
        }

        if ($spmb = Site::get('ppdb.spmb_url')) {
            $lines[] = 'TAUTAN PENDAFTARAN ONLINE (SPMB): '.$spmb;
        }

        if ($download = Site::get('ppdb.download_url')) {
            $lines[] = 'TAUTAN UNDUH BERKAS PPDB: '.$download;
        }

        if ($lines === []) {
            return '';
        }

        $lines[] = 'HALAMAN INFORMASI PPDB DI WEBSITE: '.route('ppdb');

        return "== PENERIMAAN PESERTA DIDIK BARU (PPDB) ==\n".implode("\n", $lines);
    }

    private function news(): string
    {
        $articles = Article::published()->latestPublished()->limit(8)->get();

        if ($articles->isEmpty()) {
            return '';
        }

        $lines = $articles->map(function (Article $article): string {
            $line = "- {$article->title} ({$article->formatted_date})";

            if ($article->excerpt) {
                $line .= ': '.Str::limit($this->plainText($article->excerpt), 200);
            }

            return $line.' (halaman: '.route('berita.show', $article->slug).')';
        })->all();

        $lines[] = 'HALAMAN SEMUA BERITA: '.route('berita.index');

        return "== BERITA TERBARU ==\n".implode("\n", $lines);
    }

    private function downloads(): string
    {
        $items = Download::published()->ordered()->get();

        if ($items->isEmpty()) {
            return '';
        }

        $lines = $items->map(function (Download $item): string {
            $line = "- {$item->title}";

            if ($item->uploaded_at) {
                $line .= ' ('.$item->uploaded_at->translatedFormat('d F Y').')';
            }

            return $line.' (unduh: '.$item->file_url.')';
        })->all();

        $lines[] = 'HALAMAN DOWNLOAD: '.route('download');

        return "== BERKAS YANG DAPAT DIUNDUH ==\n".implode("\n", $lines);
    }

    private function siteNavigation(): string
    {
        $lines = [
            '- Beranda: '.route('home'),
            '- Sejarah sekolah: '.route('sejarah'),
            '- Visi & Misi: '.route('visi-misi'),
            '- Struktur Organisasi: '.route('struktur-organisasi'),
            '- Sarana & Prasarana: '.route('sarana-prasarana.index'),
            '- Program Keahlian: '.route('program-keahlian.index'),
            '- Berita & Informasi: '.route('berita.index'),
            '- Prestasi Siswa: '.route('prestasi'),
            '- Download: '.route('download'),
            '- Ekstrakurikuler: '.route('ekstrakurikuler'),
            '- Organisasi Siswa: '.route('organisasi-siswa'),
            '- Teaching Factory: '.route('teaching-factory'),
            '- Informasi PPDB: '.route('ppdb'),
        ];

        return "== PETA HALAMAN WEBSITE (gunakan tautan ini saat mengarahkan pengunjung) ==\n".implode("\n", $lines);
    }

    /**
     * @param  array<int, array<string, mixed>>  $sections
     */
    private function sectionsText(array $sections): string
    {
        $parts = [];

        foreach ($sections as $section) {
            $type = $section['type'] ?? null;

            if ($type === 'list') {
                $items = collect($section['items'] ?? [])
                    ->map(fn ($item): string => $this->plainText((string) $item))
                    ->filter()
                    ->all();

                if ($items !== []) {
                    $parts[] = implode('; ', $items);
                }

                continue;
            }

            $text = $this->plainText((string) ($section['text'] ?? ''));

            if ($text !== '') {
                $parts[] = $text;
            }
        }

        return trim(implode(' ', $parts));
    }

    private function plainText(string $value): string
    {
        $text = strip_tags($value);
        $text = preg_replace('/\s+/', ' ', $text) ?? $text;

        return trim($text);
    }
}
