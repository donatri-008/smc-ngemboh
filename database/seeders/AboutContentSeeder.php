<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AboutContentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $sections = [
            'sambutan'  => 'Selamat datang di Smart Maritim Community Ngemboh...',
            'sejarah'   => 'Komunitas ini berdiri dari inisiatif nelayan lokal...',
            'visi_misi' => 'Visi: Mewujudkan nelayan Ngemboh yang sejahtera dan berkelanjutan.',
            'lambang'   => 'Lambang komunitas melambangkan...',
        ];

        foreach ($sections as $section => $content) {
            \App\Models\AboutContent::create(['section' => $section, 'content' => $content]);
        }
    }
}
