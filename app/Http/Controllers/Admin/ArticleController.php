<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreArticleRequest;
use App\Http\Requests\Admin\UpdateArticleRequest;
use App\Models\Article;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    public function index(Request $request): View
    {
        $articles = Article::query()
            ->search($request->string('q')->toString())
            ->latest()
            ->paginate(15)
            ->withQueryString();

        return view('admin.articles.index', [
            'articles' => $articles,
            'q' => $request->string('q')->toString(),
        ]);
    }

    public function create(): View
    {
        return view('admin.articles.form', [
            'article' => new Article([
                'published_at' => now(),
                'is_published' => true,
            ]),
        ]);
    }

    public function store(StoreArticleRequest $request): RedirectResponse
    {
        $article = Article::create($request->validated());

        return redirect()
            ->route('admin.articles.index')
            ->with('status', "Berita \"{$article->title}\" berhasil dibuat.");
    }

    public function edit(Article $article): View
    {
        return view('admin.articles.form', [
            'article' => $article,
        ]);
    }

    public function update(UpdateArticleRequest $request, Article $article): RedirectResponse
    {
        $article->update($request->validated());

        return redirect()
            ->route('admin.articles.index')
            ->with('status', "Berita \"{$article->title}\" berhasil diperbarui.");
    }

    public function destroy(Article $article): RedirectResponse
    {
        $title = $article->title;

        $article->delete();

        return redirect()
            ->route('admin.articles.index')
            ->with('status', "Berita \"{$title}\" berhasil dihapus.");
    }
}
