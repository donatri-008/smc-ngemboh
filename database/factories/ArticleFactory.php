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
            'title' => fake()->sentence(6),
            'slug' => fake()->slug(),
            'content' => fake()->paragraphs(4, true),
            'category' => fake()->randomElement(['produk', 'berita_acara']),
            'published_at' => now()->subDays(fake()->numberBetween(0, 90)),
        ];
    }
}
