<?php

namespace Database\Factories;

use App\Models\Article;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Article>
 */
class ArticleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => fake()->unique()->sentence(6),
            'excerpt' => fake()->paragraph(),
            'body' => fake()->paragraphs(3, true),
            'image' => null,
            'author' => fake()->name(),
            'source' => 'SMKN 1 Bantul',
            'external_url' => null,
            'published_at' => now(),
            'is_published' => true,
        ];
    }

    public function unpublished(): static
    {
        return $this->state(fn (array $attributes) => [
            'is_published' => false,
        ]);
    }
}
