<?php

namespace App\Http\Controllers;

use App\Support\Site;
use Illuminate\Contracts\View\View;

class ProfileController extends Controller
{
    public function sejarah(): View
    {
        return view('sejarah', [
            'paragraphs' => array_filter(preg_split('/\n\s*\n/', (string) Site::get('history.body', ''))),
            'title' => 'Sejarah Sekolah',
        ]);
    }

    public function visiMisi(): View
    {
        return view('visi-misi', [
            'visi' => (array) Site::get('vision.points', []),
            'misi' => array_filter(preg_split('/\n\s*\n/', (string) Site::get('mission.points', ''))),
        ]);
    }

    public function strukturOrganisasi(): View
    {
        return view('struktur-organisasi', [
            'image' => asset(Site::get('organization.chart_image', 'images/strukturorganisasi.jpg')),
        ]);
    }
}
