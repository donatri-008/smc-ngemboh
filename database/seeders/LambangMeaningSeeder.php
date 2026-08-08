<<<<<<< HEAD
<?php

namespace Database\Seeders;

use App\Models\LambangMeaning;
use Illuminate\Database\Seeder;

class LambangMeaningSeeder extends Seeder
{
    public function run(): void
    {
        // Hapus data lama agar tidak dobel setiap kali di-seed ulang
        LambangMeaning::truncate();

        $data = [
            // ===== Kolom Kiri (5 poin) =====
            [
                'judul'  => 'Dua Lengkungan',
                'isi'    => 'Melambangkan sinergi antara Universitas Negeri Surabaya dan masyarakat Desa Ngemboh yang saling melengkapi dalam mewujudkan pemberdayaan pesisir.',
                'icon'   => 'assets/9-logo/dua-lengkung.png',
                'posisi' => 'kiri',
                'urutan' => 1,
            ],
            [
                'judul'  => 'Empat Titik',
                'isi'    => 'Merepresentasikan empat pilar utama program: inovasi, edukasi, ekonomi, dan lingkungan yang menjadi fondasi keberlanjutan Smart Maritime Community.',
                'icon'   => 'assets/9-logo/empat-titik.png',
                'posisi' => 'kiri',
                'urutan' => 2,
            ],
            [
                'judul'  => 'Garis Melengkung',
                'isi'    => 'Menggambarkan alur perjalanan panjang budidaya kerang hijau, dari proses pembibitan hingga menjadi produk bernilai ekonomi tinggi.',
                'icon'   => 'assets/9-logo/garis-melengkung.png',
                'posisi' => 'kiri',
                'urutan' => 3,
            ],
            [
                'judul'  => 'Gelombang Laut',
                'isi'    => 'Simbol identitas Desa Ngemboh sebagai kawasan pesisir yang menggantungkan kehidupan pada laut dan potensi maritimnya.',
                'icon'   => 'assets/9-logo/gelombang-laut.png',
                'posisi' => 'kiri',
                'urutan' => 4,
            ],
            [
                'judul'  => 'Kerang Terbuka',
                'isi'    => 'Melambangkan keterbukaan terhadap inovasi dan peluang baru dalam mengoptimalkan potensi kerang hijau (Perna viridis) sebagai komoditas unggulan.',
                'icon'   => 'assets/9-logo/kerang-terbuka.png',
                'posisi' => 'kiri',
                'urutan' => 5,
            ],

            // ===== Kolom Kanan (4 poin) =====
            [
                'judul'  => 'Kombinasi Warna',
                'isi'    => 'Perpaduan warna biru dan hijau merepresentasikan keseimbangan antara ekosistem laut yang lestari dan pertumbuhan ekonomi masyarakat.',
                'icon'   => 'assets/9-logo/kombinasi-warna.png',
                'posisi' => 'kanan',
                'urutan' => 1,
            ],
            [
                'judul'  => 'Long-Econ',
                'isi'    => 'Merepresentasikan program utama Longline Economy Empowerment, inovasi budidaya kerang hijau berbasis sistem longline apung.',
                'icon'   => 'assets/9-logo/long-econ.png',
                'posisi' => 'kanan',
                'urutan' => 2,
            ],
            [
                'judul'  => 'Perna Viridis',
                'isi'    => 'Nama ilmiah kerang hijau yang menjadi komoditas utama dan sumber penghidupan masyarakat pesisir Desa Ngemboh.',
                'icon'   => 'assets/9-logo/perna-viridis.png',
                'posisi' => 'kanan',
                'urutan' => 3,
            ],
            [
                'judul'  => 'Posisi Melingkar',
                'isi'    => 'Melambangkan semangat gotong royong dan kebersamaan seluruh elemen masyarakat dalam mendukung keberlanjutan program.',
                'icon'   => 'assets/9-logo/posisi-melingkar.png',
                'posisi' => 'kanan',
                'urutan' => 4,
            ],
        ];

        foreach ($data as $item) {
            LambangMeaning::create($item);
        }
    }
=======
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
>>>>>>> 7c2b0c38c7cbb0458913dc97ac2a87842c5a8228
}