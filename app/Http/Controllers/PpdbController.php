<?php

namespace App\Http\Controllers;

use App\Models\PpdbProgram;
use App\Models\PpdbStep;
use App\Support\Site;
use Illuminate\Contracts\View\View;

class PpdbController extends Controller
{
    public function index(): View
    {
        return view('ppdb', [
            'steps' => PpdbStep::ordered()->get(),
            'programs' => PpdbProgram::published()
                ->with('programKeahlian')
                ->ordered()
                ->get(),
            'spmbUrl' => Site::get('ppdb.spmb_url', 'https://spmb.jogjaprov.go.id/'),
            'downloadUrl' => Site::get('ppdb.download_url', 'https://drive.google.com/file/d/1GE0xfkIQZXSzfsiET4xliHjlveHxyLb4/view'),
        ]);
    }
}
