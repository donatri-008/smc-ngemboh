<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TeamProfileSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        foreach (['BPH', 'Penanggung Jawab', 'PPK Ormawa'] as $tim) {
            \App\Models\TeamProfile::factory(4)->create(['tim' => $tim]);
        }
    }
}