<?php

namespace Database\Seeders;

use App\Models\Article;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;

class ArticleSeeder extends Seeder
{
    public function run(): void
    {
        $path = database_path('data/articles.json');

        $items = json_decode(file_get_contents($path), true, 512, JSON_THROW_ON_ERROR);

        foreach ($items as $item) {
            Article::updateOrCreate(
                ['slug' => $item['slug']],
                [
                    'title' => $item['title'],
                    'excerpt' => $item['excerpt'],
                    'body' => $item['body'],
                    'image' => ltrim($item['image'] ?? '', '/') ?: null,
                    'author' => $item['author'] ?? 'SMKN 1 BANTUL',
                    'source' => null,
                    'external_url' => null,
                    'published_at' => Carbon::parse($item['body_date'] ?? $item['published_at'] ?? now())->startOfDay(),
                    'is_published' => true,
                ]
            );
        }
    }
}
