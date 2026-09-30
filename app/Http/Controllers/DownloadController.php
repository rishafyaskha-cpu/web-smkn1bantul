<?php

namespace App\Http\Controllers;

use App\Models\Download;
use Illuminate\Contracts\View\View;

class DownloadController extends Controller
{
    public function index(): View
    {
        return view('download', [
            'downloads' => Download::published()->ordered()->get(),
        ]);
    }
}
