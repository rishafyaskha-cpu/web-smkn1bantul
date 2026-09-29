<?php

namespace App\Http\Controllers;

use App\Models\Ekstrakurikuler;
use App\Models\OrganisasiSiswa;
use Illuminate\Contracts\View\View;

class GalleryPageController extends Controller
{
    public function ekstrakurikuler(): View
    {
        return view('ekstrakurikuler', [
            'items' => Ekstrakurikuler::published()->ordered()->get(),
            'rows' => Ekstrakurikuler::published()->ordered()->get()
                ->values()
                ->map(fn ($item, $i) => [$i + 1, $item->name])
                ->all(),
        ]);
    }

    public function organisasiSiswa(): View
    {
        return view('organisasi-siswa', [
            'items' => OrganisasiSiswa::published()->ordered()->get(),
            'rows' => OrganisasiSiswa::published()->ordered()->get()
                ->values()
                ->map(fn ($item, $i) => [$i + 1, $item->name])
                ->all(),
        ]);
    }
}
