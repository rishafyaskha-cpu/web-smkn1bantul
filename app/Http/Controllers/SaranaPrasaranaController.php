<?php

namespace App\Http\Controllers;

use App\Models\SaranaPrasarana;
use Illuminate\Contracts\View\View;

class SaranaPrasaranaController extends Controller
{
    public function index(): View
    {
        return view('sarana-prasarana.index', [
            'items' => SaranaPrasarana::published()->ordered()->get(),
        ]);
    }

    public function show(SaranaPrasarana $saranaPrasarana): View
    {
        abort_unless($saranaPrasarana->is_published, 404);

        return view('sarana-prasarana.show', [
            'item' => $saranaPrasarana,
        ]);
    }
}
