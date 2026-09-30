<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\ProgramKeahlian;
use App\Models\SaranaPrasarana;
use Illuminate\Http\Response;

class SitemapController extends Controller
{
    public function index(): Response
    {
        $urls = collect([
            ['loc' => route('home'), 'changefreq' => 'daily', 'priority' => '1.0'],
            ['loc' => route('sejarah'), 'changefreq' => 'monthly', 'priority' => '0.7'],
            ['loc' => route('visi-misi'), 'changefreq' => 'monthly', 'priority' => '0.7'],
            ['loc' => route('struktur-organisasi'), 'changefreq' => 'monthly', 'priority' => '0.6'],
            ['loc' => route('sarana-prasarana.index'), 'changefreq' => 'monthly', 'priority' => '0.8'],
            ['loc' => route('program-keahlian.index'), 'changefreq' => 'monthly', 'priority' => '0.9'],
            ['loc' => route('berita.index'), 'changefreq' => 'daily', 'priority' => '0.9'],
            ['loc' => route('prestasi'), 'changefreq' => 'weekly', 'priority' => '0.8'],
            ['loc' => route('download'), 'changefreq' => 'weekly', 'priority' => '0.7'],
            ['loc' => route('ekstrakurikuler'), 'changefreq' => 'monthly', 'priority' => '0.7'],
            ['loc' => route('organisasi-siswa'), 'changefreq' => 'monthly', 'priority' => '0.7'],
            ['loc' => route('teaching-factory'), 'changefreq' => 'monthly', 'priority' => '0.7'],
            ['loc' => route('ppdb'), 'changefreq' => 'daily', 'priority' => '0.9'],
        ]);

        ProgramKeahlian::published()->ordered()->get()->each(fn ($p) => $urls->push([
            'loc' => route('program-keahlian.show', $p),
        ]));

        SaranaPrasarana::published()->ordered()->get()->each(fn ($s) => $urls->push([
            'loc' => route('sarana-prasarana.show', $s),
        ]));

        Article::published()->latestPublished()->get()->each(fn ($a) => $urls->push([
            'loc' => route('berita.show', $a),
            'lastmod' => $a->updated_at->toAtomString(),
            'changefreq' => 'monthly',
            'priority' => '0.6',
        ]));

        $xml = '<?xml version="1.0" encoding="UTF-8"?>'."\n".view('sitemap', ['urls' => $urls])->render();

        return response($xml, 200, ['Content-Type' => 'application/xml']);
    }

    public function robots(): Response
    {
        $lines = [
            'User-agent: *',
            'Disallow: /admin',
            'Allow: /',
            '',
            'Sitemap: '.route('sitemap'),
        ];

        return response(implode("\n", $lines), 200, ['Content-Type' => 'text/plain']);
    }
}
