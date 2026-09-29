<?php

namespace App\Http\Controllers;

use App\Models\TeachingFactory;
use Illuminate\Contracts\View\View;

class TeachingFactoryController extends Controller
{
    public function index(): View
    {
        return view('teaching-factory', [
            'partners' => TeachingFactory::published()
                ->with('programKeahlian')
                ->ordered()
                ->get(),
        ]);
    }
}
