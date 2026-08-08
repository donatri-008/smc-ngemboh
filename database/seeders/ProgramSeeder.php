<?php

namespace Database\Seeders;

use App\Models\Program;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;

class ProgramSeeder extends Seeder
{
    public function run(): void
    {
        Program::truncate();

        $data = [
            [
                'nama' => 'Long-Econ Empowerment',
                'gambar' => 'program-1.jpg',
                'icon' => 'sparkles',
                'deskripsi' => 'Inovasi budidaya kerang hijau dengan sistem longline apung yang lebih adaptif dan produktif.',
                'konten' => "Long-Econ merupakan program inovasi budidaya kerang hijau yang mengembangkan sistem longline apung sebagai solusi terhadap metode budidaya konvensional yang masih menggunakan metode tancap bambu. Sistem ini dirancang agar lebih adaptif terhadap perubahan cuaca, gelombang, dan fluktuasi salinitas, sehingga mampu meningkatkan produktivitas sekaligus mengurangi risiko gagal panen.\n\nMelalui kegiatan survei lokasi, instalasi sarana budidaya, pelatihan teknis, serta pendampingan operasional, masyarakat dibekali kemampuan untuk menerapkan teknologi budidaya yang lebih efektif, efisien, dan berkelanjutan. Program ini diharapkan mampu meningkatkan hasil produksi kerang hijau serta memperkuat ketahanan ekonomi masyarakat pesisir Desa Ngemboh.",
            ],
            [
                'nama' => 'Perna Nutri',
                'gambar' => 'program-2.jpg',
                'icon' => 'cake',
                'deskripsi' => 'Pengolahan kerang hijau menjadi produk pangan bernilai tambah seperti Virlong Chips dan Nugget.',
                'konten' => "Perna Nutri merupakan program pemberdayaan masyarakat yang berfokus pada pengolahan kerang hijau (Perna viridis) menjadi produk pangan bernilai tambah. Selama ini sebagian besar hasil budidaya masih dipasarkan dalam bentuk segar sehingga nilai ekonominya relatif rendah. Oleh karena itu, program ini menghadirkan inovasi pengolahan menjadi produk seperti Virlong Chips dan Virlong Nugget yang memiliki daya saing lebih tinggi.\n\nMasyarakat memperoleh pelatihan produksi, pengemasan, pengendalian mutu, hingga pendampingan usaha sehingga mampu menghasilkan produk yang aman, berkualitas, dan siap dipasarkan. Melalui Perna Nutri, diharapkan tercipta peluang usaha baru yang dapat meningkatkan pendapatan masyarakat pesisir secara berkelanjutan.",
            ],
            [
                'nama' => 'Perna Cyclical',
                'gambar' => 'program-3.jpg',
                'icon' => 'arrow-path',
                'deskripsi' => 'Mengubah limbah cangkang kerang hijau menjadi CalciFeed, tepung kalsium untuk pakan unggas.',
                'konten' => "Perna Cyclical merupakan program yang mengubah limbah cangkang kerang hijau menjadi produk bernilai ekonomi berupa CalciFeed, yaitu tepung kalsium yang dimanfaatkan sebagai bahan baku pakan unggas.\n\nProgram ini tidak hanya mengurangi pencemaran lingkungan akibat penumpukan limbah cangkang, tetapi juga membuka peluang usaha baru berbasis ekonomi sirkular. Masyarakat mendapatkan pelatihan mulai dari proses pengolahan limbah, produksi CalciFeed, hingga strategi pemasaran dan pengelolaan usaha. Dengan demikian, limbah yang sebelumnya tidak bernilai dapat diubah menjadi produk yang memberikan manfaat ekonomi sekaligus mendukung pelestarian lingkungan.",
            ],
            [
                'nama' => 'Perna Brand Connect',
                'gambar' => null, // nyusul, belum ada fotonya
                'icon' => 'megaphone',
                'deskripsi' => 'Pengembangan branding, kemasan, dan pemasaran digital untuk produk lokal Desa Ngemboh.',
                'konten' => "Perna Brand Connect merupakan program pengembangan kapasitas masyarakat dalam membangun identitas merek dan memperluas pemasaran produk lokal Desa Ngemboh. Potensi produk unggulan desa yang besar sering kali belum diimbangi dengan kemampuan branding, desain kemasan, dan pemasaran digital, sehingga daya saing produk masih terbatas. Melalui pelatihan branding, desain kemasan, digital marketing, pengelolaan marketplace, serta pendampingan promosi, masyarakat didorong untuk mampu memasarkan produknya secara lebih profesional. Program ini bertujuan menciptakan produk lokal yang memiliki identitas kuat, kemasan yang menarik, serta akses pasar yang lebih luas sehingga mampu meningkatkan penjualan dan keberlanjutan usaha masyarakat.",
            ],
        ];

        foreach ($data as $item) {
            Program::create([
                'nama' => $item['nama'],
                'slug' => Str::slug($item['nama']),
                'deskripsi' => $item['deskripsi'],
                'icon' => $item['icon'],
                'gambar' => $item['gambar'],
                'konten' => $item['konten'],
            ]);
        }
    }
}
