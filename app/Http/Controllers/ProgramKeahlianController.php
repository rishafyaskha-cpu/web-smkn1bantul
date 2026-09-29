<?php

namespace App\Http\Controllers;

use App\Models\ProgramKeahlian;
use Illuminate\Contracts\View\View;

class ProgramKeahlianController extends Controller
{
    public function index(): View
    {
        return view('program-keahlian.index', [
            'programs' => ProgramKeahlian::published()->ordered()->get(),
        ]);
    }

    public function show(ProgramKeahlian $programKeahlian): View
    {
        abort_unless($programKeahlian->is_published, 404);

        return view('program-keahlian.show', [
            'program' => $programKeahlian,
            'related' => ProgramKeahlian::published()
                ->whereKeyNot($programKeahlian->id)
                ->ordered()
                ->limit(6)
                ->get(),
        ]);
    }
}
