<?php

namespace Database\Seeders;

use App\Models\AboutContent;
use Illuminate\Database\Seeder;

class VisiMisiSeeder extends Seeder
{
    public function run(): void
    {
        AboutContent::updateOrCreate(
            ['section' => 'visi'],
            [
                'title' => 'Visi Kami',
                'content' => '"Menjadi Program Pemberdayaan Masyarakat pesisir Desa Ngemboh yang inovatif dan berkelanjutan dalam mewujudkan optimalisasi potensi maritim pada sektor kerang hijau."',
            ]
        );

        AboutContent::updateOrCreate(
            ['section' => 'misi'],
            [
                'title' => 'Misi Kami',
                // Pisahin tiap poin misi pakai baris baru (enter), nanti otomatis jadi list di tampilan
                'content' => "Mengoptimalkan Potensi lokal pesisir melalui inovasi dan teknologi tepat guna.\nMeningkatkan kapasitas masyarakat dalam pengelolaan dan pemasaran hasil Hilirisasi Kerang Hijau.\nTerciptanya ekonomi sirkular melalui pemanfaatan hasil dan limbah cangkang kerang hijau secara berkelanjutan.\nMembangun kolaborasi dengan berbagai pihak  untuk mendukung keberlanjutan program.",
            ]
        );
    }
}