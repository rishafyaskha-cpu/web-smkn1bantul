<?php

namespace App\Http\Controllers;

use App\Models\Achievement;
use Illuminate\Contracts\View\View;

class PrestasiController extends Controller
{
    public function index(): View
    {
        return view('prestasi.index', [
            'achievements' => Achievement::published()->ordered()->paginate(18),
        ]);
    }
}
