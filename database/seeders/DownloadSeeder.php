<?php

namespace Database\Seeders;

use App\Models\Download;
use Illuminate\Database\Seeder;

class DownloadSeeder extends Seeder
{
    public function run(): void
    {
        $path = database_path('data/downloads.json');

        $items = json_decode(file_get_contents($path), true, 512, JSON_THROW_ON_ERROR);

        foreach ($items as $index => $item) {
            Download::updateOrCreate(
                ['title' => $item['title']],
                [
                    'file' => ltrim($item['file'], '/'),
                    'file_size' => $item['file_size'] ?? null,
                    'uploaded_at' => $item['uploaded_at'] ?? null,
                    'is_published' => true,
                    'sort_order' => $index + 1,
                ]
            );
        }
    }
}
