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
        foreach (['tim1', 'tim2', 'tim3'] as $tim) {
            \App\Models\TeamProfile::factory(4)->create(['tim' => $tim]);
        }
    }
}
