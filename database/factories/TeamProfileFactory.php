<?php

namespace Database\Factories;

use App\Models\TeamProfile;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<TeamProfile>
 */
class TeamProfileFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nama' => fake()->name(),
            'jabatan' => fake()->randomElement(['Ketua', 'Sekretaris', 'Bendahara', 'Anggota']),
            'tim' => fake()->randomElement(['tim1', 'tim2', 'tim3']),
            'urutan' => fake()->numberBetween(0, 10),
        ];
    }
}
