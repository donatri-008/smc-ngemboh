<?php

namespace Database\Seeders;

use App\Models\LambangMeaning;
use Illuminate\Database\Seeder;

class LambangMeaningSeeder extends Seeder
{
    public function run(): void
    {
        LambangMeaning::truncate();

        // 5 poin sisi KIRI
        $kiri = [
            ['judul' => 'Long-Econ',          'isi' => 'Tulis penjelasan Logo Lingkaran di sini...'],
            ['judul' => 'Bentuk dua lengkung menyerupai figure manusia yang saling mengitari', 'isi' => 'Tulis penjelasan bentuk daun/gelombang di sini...'],
            ['judul' => 'Posisi melingkar',      'isi' => 'Tulis penjelasan posisi melingkar di sini...'],
            ['judul' => 'Perna viridis yang menjadi pusat logo', 'isi' => 'Tulis penjelasan kerang hijau di sini...'],
            ['judul' => 'Kerang yang terbuka',   'isi' => 'Tulis penjelasan kerang yang terbuka di sini...'],
        ];

        // 4 poin sisi KANAN
        $kanan = [
            ['judul' => 'Gelombang Laut di bagian bawah', 'isi' => 'Tulis penjelasan gelombang biru di sini...'],
            ['judul' => 'Garis melengkung yang melintas di atas gelombang', 'isi' => 'Tulis penjelasan garis melengkung di sini...'],
            ['judul' => 'Empat titik pada garis tersebut melambangkan pelampung budidaya sekaligus', 'isi' => 'Tulis penjelasan empat elemen warna di sini...'],
            ['judul' => 'Secara keseluruhan, kombinasi warna biru', 'isi' => 'Tulis penjelasan kombinasi warna di sini...'],
        ];

        $urutan = 1;
        foreach ($kiri as $item) {
            LambangMeaning::create([
                'judul' => $item['judul'],
                'isi' => $item['isi'],
                'posisi' => 'kiri',
                'urutan' => $urutan++,
            ]);
        }

        $urutan = 1;
        foreach ($kanan as $item) {
            LambangMeaning::create([
                'judul' => $item['judul'],
                'isi' => $item['isi'],
                'posisi' => 'kanan',
                'urutan' => $urutan++,
            ]);
        }
    }
}