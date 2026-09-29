<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Achievement;
use App\Models\Article;
use Illuminate\Contracts\View\View;

class DashboardController extends Controller
{
    public function __invoke(): View
    {
        return view('admin.dashboard', [
            'articleCount' => Article::count(),
            'publishedArticleCount' => Article::published()->count(),
            'achievementCount' => Achievement::count(),
            'publishedAchievementCount' => Achievement::published()->count(),
            'latestArticles' => Article::latest()->limit(5)->get(),
        ]);
    }
}
