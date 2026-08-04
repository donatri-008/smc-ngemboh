<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StatisticSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $tahun = range(now()->year - 4, now()->year);

        foreach ($tahun as $t) {
            \App\Models\Statistic::create([
                'type' => 'lingkungan', 'kategori' => 'Kualitas Air',
                'label' => (string) $t, 'value' => fake()->numberBetween(60, 95),
                'tahun' => $t, 'deskripsi' => 'Indeks kualitas air tahunan.',
            ]);
            \App\Models\Statistic::create([
                'type' => 'demografi', 'kategori' => 'Jumlah Nelayan',
                'label' => (string) $t, 'value' => fake()->numberBetween(150, 400),
                'tahun' => $t, 'deskripsi' => 'Jumlah nelayan terdaftar per tahun.',
            ]);
        }
    }
}
