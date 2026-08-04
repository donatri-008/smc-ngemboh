<?php

namespace Database\Factories;

use App\Models\Legality;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Legality>
 */
class LegalityFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nama_dokumen' => fake()->randomElement(['Akta Pendirian', 'SK Kemenkumham', 'Sertifikat Halal', 'NIB']),
            'nomor' => fake()->numerify('AHU-####/##/####'),
            'file' => 'legalities/dummy.pdf', // ganti manual/lewat admin setelah seed
            'tanggal_terbit' => fake()->dateTimeBetween('-3 years', 'now'),
        ];
    }
}
