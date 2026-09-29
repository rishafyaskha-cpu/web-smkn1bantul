<?php

namespace App\Support;

use App\Models\Achievement;
use App\Models\Article;
use App\Models\Ekstrakurikuler;
use App\Models\OrganisasiSiswa;
use App\Models\PpdbProgram;
use App\Models\PpdbStep;
use App\Models\ProgramKeahlian;
use App\Models\SaranaPrasarana;
use App\Models\SiteStatistic;
use App\Models\TeachingFactory;
use Illuminate\Support\Facades\Cache;

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
            $lines[] = 'SEJARAH SINGKAT: '.$this->plainText($history);
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
            return $item->description
                ? "- {$item->title}: ".$this->plainText($item->description)
                : "- {$item->title}";
        })->all();

        return "== SARANA DAN PRASARANA ==\n".implode("\n", $lines);
    }

    private function extracurriculars(): string
    {
        $items = Ekstrakurikuler::published()->ordered()->get();

        if ($items->isEmpty()) {
            return '';
        }

        return "== EKSTRAKURIKULER ==\n".$items->pluck('name')->implode(', ');
    }

    private function studentOrganizations(): string
    {
        $items = OrganisasiSiswa::published()->ordered()->get();

        if ($items->isEmpty()) {
            return '';
        }

        return "== ORGANISASI SISWA ==\n".$items->pluck('name')->implode(', ');
    }

    private function teachingFactories(): string
    {
        $items = TeachingFactory::published()->ordered()->get();

        if ($items->isEmpty()) {
            return '';
        }

        $lines = $items->map(function (TeachingFactory $item): string {
            return $item->partner_name
                ? "- {$item->title} bekerja sama dengan {$item->partner_name}"
                : "- {$item->title}";
        })->all();

        return "== TEACHING FACTORY (KEMITRAAN INDUSTRI) ==\n".implode("\n", $lines);
    }

    private function achievements(): string
    {
        $items = Achievement::published()->ordered()->limit(15)->get();

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
            $lines[] = $programs->map(fn (PpdbProgram $program): string => "- {$program->title} ({$program->category})")->implode("\n");
        }

        if ($spmb = Site::get('ppdb.spmb_url')) {
            $lines[] = 'TAUTAN PENDAFTARAN ONLINE (SPMB): '.$spmb;
        }

        if ($lines === []) {
            return '';
        }

        return "== PENERIMAAN PESERTA DIDIK BARU (PPDB) ==\n".implode("\n", $lines);
    }

    private function news(): string
    {
        $articles = Article::published()->latest()->limit(5)->get();

        if ($articles->isEmpty()) {
            return '';
        }

        $lines = $articles->map(function (Article $article): string {
            return "- {$article->title} ({$article->formatted_date})";
        })->all();

        return "== BERITA TERBARU ==\n".implode("\n", $lines);
    }

    private function plainText(string $value): string
    {
        $text = strip_tags($value);
        $text = preg_replace('/\s+/', ' ', $text) ?? $text;

        return trim($text);
    }
}
