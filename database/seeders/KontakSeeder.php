<?php

namespace Database\Seeders;

use App\Models\AboutContent;
use Illuminate\Database\Seeder;

class KontakSeeder extends Seeder
{
    public function run(): void
    {
        $data = [
            'whatsapp'  => '+62 811 2345 6789',
            'email'     => 'support@maritimehub.id',
            'instagram' => '@maritimehub_id',
            'shopee'    => '@maritimehub_id',
            'tiktok'    => '@maritimehub_id',
        ];

        foreach ($data as $section => $value) {
            AboutContent::updateOrCreate(
                ['section' => $section],
                ['content' => $value]
            );
        }
    }
}
