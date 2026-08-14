<?php

namespace Database\Seeders;

use App\Models\AboutContent;
use Illuminate\Database\Seeder;

class AboutContentSeeder extends Seeder
{
    public function run(): void
    {
        AboutContent::updateOrCreate(
            ['section' => 'lambang'],
            [
                'content' => 'Lambang komunitas melambangkan sinergi antara akademisi dan masyarakat pesisir dalam mewujudkan pemberdayaan berkelanjutan.',
                'image'   => 'assets/9-logo/long-econ.webp',
            ]
        );
    }
}