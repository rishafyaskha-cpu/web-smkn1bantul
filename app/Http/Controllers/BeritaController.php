<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class BeritaController extends Controller
{
    public function index(Request $request): View
    {
        $articles = Article::published()
            ->search($request->string('q')->toString())
            ->latestPublished()
            ->paginate(9)
            ->withQueryString();

        return view('berita.index', [
            'articles' => $articles,
            'q' => $request->string('q')->toString(),
        ]);
    }

    public function show(Article $berita): View
    {
        abort_unless($berita->is_published, 404);

        $related = Article::published()
            ->whereKeyNot($berita->id)
            ->latestPublished()
            ->limit(3)
            ->get();

        return view('berita.show', [
            'article' => $berita,
            'related' => $related,
        ]);
    }
}
