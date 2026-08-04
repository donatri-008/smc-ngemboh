<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nama' => fake()->words(3, true),
            'deskripsi' => fake()->sentence(12),
            'harga' => fake()->numberBetween(15000, 250000),
            'stok' => fake()->numberBetween(0, 50),
            'kategori' => fake()->randomElement(['lapak', 'produk_luaran']),
        ];
    }
}
