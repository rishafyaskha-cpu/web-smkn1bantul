<?php

namespace Database\Seeders;

use App\Models\SaranaPrasarana;
use Illuminate\Database\Seeder;

class SaranaPrasaranaSeeder extends Seeder
{
    public function run(): void
    {
        $path = database_path('data/sarana.json');

        $items = json_decode(file_get_contents($path), true, 512, JSON_THROW_ON_ERROR);

        foreach ($items as $index => $item) {
            SaranaPrasarana::updateOrCreate(
                ['title' => $item['title']],
                [
                    'image' => ltrim($item['images'] ?? '', '/'),
                    'description' => $item['description'] ?? null,
                    'is_published' => true,
                    'sort_order' => $index + 1,
                ]
            );
        }
    }
}
