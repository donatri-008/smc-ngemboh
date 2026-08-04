<?php

namespace Database\Factories;

use App\Models\EnvironmentInfo;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<EnvironmentInfo>
 */
class EnvironmentInfoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => fake()->sentence(5),
            'content' => fake()->paragraphs(3, true),
            'category' => fake()->randomElement(['informasi', 'peraturan']),
        ];
    }
}
