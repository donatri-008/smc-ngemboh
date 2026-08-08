<<<<<<< HEAD
<?php

namespace Database\Seeders;

use App\Models\HistoryMilestone;
use Illuminate\Database\Seeder;

class HistoryMilestoneSeeder extends Seeder
{
    public function run(): void
    {
        // Hapus data lama dulu biar gak dobel kalau seeder dijalankan berkali-kali
        HistoryMilestone::truncate();

        $data = [
            [
                'judul' => 'Potensi & Tantangan Pesisir',
                'isi' => "1. Desa Ngimboh. Cheklt kaya alam potensi kerang hijau Perna viridis.\n2. Kendala: Metode budidaya kurang optimal, distribusi pasar belum berkelanjutan, dan pengelolaan limbah kerang belum optimal.",
                'urutan' => 1,
            ],
            [
                'judul' => '2026: Inisiasi & Kolaborasi',
                'isi' => "1. PPK ORMAWA DPM FIP UNESA hadir menginisiasi solusi.\n2. Kolaborasi multipihak: Pemdes Ngemboh, kelompok nelayan, Persatuan Istri Nelayan (PIN), PKK, BUMDes, dan berbagai mitra strategis.",
                'urutan' => 2,
            ],
            [
                'judul' => 'Perumusan Wadah & 4 Program Integrasi',
                'isi' => "Membentuk Smart Maritim Community (SMC) dengan 4 pilar program:\n1. LOND-ECON: Budidaya kerang hijau sistem longline apung\n2. Perna Nutri: Hilirisasi daging kerang hijau\n3. Perna Cyclical: Pengelolaan limbah cangkang kerang hijau\n4. Perna Brand Connect: Branding produk dan pemasaran digital",
                'urutan' => 3,
            ],
            [
                'judul' => 'Dampak & Visi Keberlanjutan',
                'isi' => "Mewujudkan Desa Ngemboh sebagai desa maritim mandiri & inovatif, serta menciptakan ekosistem pemberdayaan berkelanjutan yang siap direplikasi di wilayah pesisir lainnya.",
                'urutan' => 4,
            ],
        ];

        foreach ($data as $item) {
            HistoryMilestone::create($item);
        }
    }
=======
<?php

namespace Database\Seeders;

use App\Models\HistoryMilestone;
use Illuminate\Database\Seeder;

class HistoryMilestoneSeeder extends Seeder
{
    public function run(): void
    {
        // Hapus data lama dulu biar gak dobel kalau seeder dijalankan berkali-kali
        HistoryMilestone::truncate();

        $data = [
            [
                'judul' => 'Potensi & Tantangan Pesisir',
                'isi' => "1. Desa Ngimboh. Cheklt kaya alam potensi kerang hijau Perna viridis.\n2. Kendala: Metode budidaya kurang optimal, distribusi pasar belum berkelanjutan, dan pengelolaan limbah kerang belum optimal.",
                'urutan' => 1,
            ],
            [
                'judul' => '2026: Inisiasi & Kolaborasi',
                'isi' => "1. PPK ORMAWA DPM FIP UNESA hadir menginisiasi solusi.\n2. Kolaborasi multipihak: Pemdes Ngemboh, kelompok nelayan, Persatuan Istri Nelayan (PIN), PKK, BUMDes, dan berbagai mitra strategis.",
                'urutan' => 2,
            ],
            [
                'judul' => 'Perumusan Wadah & 4 Program Integrasi',
                'isi' => "Membentuk Smart Maritim Community (SMC) dengan 4 pilar program:\n1. LOND-ECON: Budidaya kerang hijau sistem longline apung\n2. Perna Nutri: Hilirisasi daging kerang hijau\n3. Perna Cyclical: Pengelolaan limbah cangkang kerang hijau\n4. Perna Brand Connect: Branding produk dan pemasaran digital",
                'urutan' => 3,
            ],
            [
                'judul' => 'Dampak & Visi Keberlanjutan',
                'isi' => "Mewujudkan Desa Ngemboh sebagai desa maritim mandiri & inovatif, serta menciptakan ekosistem pemberdayaan berkelanjutan yang siap direplikasi di wilayah pesisir lainnya.",
                'urutan' => 4,
            ],
        ];

        foreach ($data as $item) {
            HistoryMilestone::create($item);
        }
    }
>>>>>>> 7c2b0c38c7cbb0458913dc97ac2a87842c5a8228
}