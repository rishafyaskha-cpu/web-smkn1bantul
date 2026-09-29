<?php

namespace Database\Factories;

use App\Models\Achievement;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Achievement>
 */
class AchievementFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => fake()->unique()->sentence(4),
            'student_name' => fake()->name(),
            'class_name' => 'XII '.fake()->randomElement(['RPL 1', 'TKJ 2', 'AKL 1', 'MP 2']),
            'description' => fake()->sentence(12),
            'image' => null,
            'level' => fake()->randomElement(['Kabupaten', 'Provinsi', 'Nasional']),
            'achieved_at' => now(),
            'is_featured' => false,
            'is_published' => true,
            'sort_order' => 0,
        ];
    }

    public function unpublished(): static
    {
        return $this->state(fn (array $attributes) => [
            'is_published' => false,
        ]);
    }
}
