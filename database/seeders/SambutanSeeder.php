<?php

namespace Database\Seeders;

use App\Models\Sambutan;
use Illuminate\Database\Seeder;

class SambutanSeeder extends Seeder
{
    public function run(): void
    {
        // Hapus semua data lama agar tidak dobel
        Sambutan::truncate();

        $data = [
            [
                'nama' => 'Ibu Ana Mukhlisah S.Pd.',
                'jabatan' => 'Kepala Desa Ngemboh',
                'foto' => 'sambutan/Ana Mukhlisah S.Pd (Kepala Desa Ngemboh).JPG',
                'isi_sambutan' => 'Assalamu’alaikum Warahmatullahi Wabarakatuh.

Puji syukur ke hadirat Allah SWT atas rahmat dan karunia-Nya. Atas nama Pemerintah Desa Ngemboh, kami menyampaikan apresiasi setinggi-tingginya serta selamat datang kepada Tim PPK Ormawa DPM FIP Universitas Negeri Surabaya atas dedikasi dan pengabdian yang direalisasikan di desa kami.

Kami berharap sinergi strategis antara Universitas Negeri Surabaya dan Pemerintah Desa Ngemboh ini dapat terus terjalin secara berkelanjutan. Semoga seluruh inisiatif dan inovasi yang telah dijalankan memberikan manfaat yang luas serta berdaya guna bagi kemajuan seluruh warga Desa Ngemboh.

Wassalamu’alaikum Warahmatullahi Wabarakatuh.',
                'urutan' => 1,
            ],

            [
                'nama' => 'Bpk. Aditya Chandra Setiawan, S.Pd., M.Pd.',
                'jabatan' => 'Dosen Pendamping PPK ORMAWA',
                'foto' => 'sambutan/Aditya Chandra Setiawan, S.Pd., M.Pd. (Dosen Pendamping PPK ORMAWA).jpg',
                'isi_sambutan' => 'Selamat datang di Smart Maritime Community Ngemboh. Melalui wadah ini, kita berupaya menyinergikan kearifan lokal masyarakat pesisir dengan teknologi modern sebagai langkah menuju desa maritim yang lebih maju.

Tujuan kami bukan hanya meningkatkan kesejahteraan masyarakat, tetapi juga menjaga kelestarian ekosistem laut agar tetap lestari bagi generasi mendatang. Melalui kolaborasi, inovasi, dan semangat gotong royong, kami berharap Smart Maritime Community dapat menjadi ruang belajar, berkembang, dan berdaya bersama.

Mari kita jadikan website ini sebagai media informasi, edukasi, sekaligus penghubung bagi seluruh pihak yang memiliki kepedulian terhadap kemajuan Desa Ngemboh.

Terima kasih atas dukungan dan partisipasi seluruh masyarakat.

Wassalamu’alaikum Warahmatullahi Wabarakatuh.',
                'urutan' => 2,
            ],

            [
                'nama' => 'Bpk. Widya Nusantara, S.Pd., M.Pd.',
                'jabatan' => 'Dosen Pembina DPM FIP',
                'foto' => 'sambutan/Widya Nusantara, S.Pd., M.Pd (Dosen Pembina DPM FIP).jpg',
                'isi_sambutan' => 'Puji syukur ke hadirat Tuhan Yang Maha Esa. Website ini hadir sebagai media informasi dan dokumentasi perjalanan program Long-Econ (Longline Economy Empowerment), sebuah inisiatif pemberdayaan masyarakat pesisir di Desa Ngemboh, Kabupaten Gresik.

Melalui pendekatan kolaboratif, program ini mengintegrasikan inovasi teknologi, penguatan kapasitas, hingga transformasi menuju Smart Maritime Community.

PPK Ormawa DPM FIP menjadi wujud nyata Mahasiswa Berdampak—unggul secara akademik sekaligus mampu menjadi agen perubahan yang solutif. Semangat ini sejalan dengan komitmen Universitas Negeri Surabaya, "Satu Langkah di Depan".

Terima kasih kepada seluruh pihak yang telah mendukung. Semoga platform ini memperkuat kolaborasi demi mewujudkan masyarakat yang berdaya, sejahtera, dan berkelanjutan.

Semoga inovasi yang telah diberikan mampu membawa dampak nyata bagi keberlangsungan jangka panjang Desa Ngemboh.

UNESA Satu Langkah di Depan.
PPK Ormawa – Mahasiswa Berdampak, Berkarya untuk Masyarakat.',
                'urutan' => 3,
            ],

            [
                'nama' => 'Bpk. Prof. Dr. Mochamad Nursalim, M.Si.',
                'jabatan' => 'Dekan FIP UNESA',
                'foto' => 'sambutan/Prof. Dr. Mochamad Nursalim, M.Si (Dekan FIP UNESA).jpg',
                'isi_sambutan' => 'Assalamu’alaikum Warahmatullahi Wabarakatuh.

Puji syukur kita panjatkan ke hadirat Allah SWT atas segala rahmat dan karunia-Nya. Kehadiran website Smart Maritime Community Ngemboh ini merupakan wujud komitmen kami dalam mendokumentasikan, menyebarluaskan praktik baik, inovasi, serta memperkenalkan potensi Desa Ngemboh kepada masyarakat yang lebih luas.

Kami meyakini bahwa keberhasilan pendidikan tidak hanya diukur dari capaian akademik, tetapi juga dari kepedulian sosial dan kemampuan mahasiswa dalam menghadirkan solusi nyata bagi masyarakat. Melalui program Long-Econ (Longline Economy Empowerment), kami berupaya mengembangkan potensi lokal Desa Ngemboh melalui kolaborasi antara perguruan tinggi, pemerintah desa, masyarakat, dan berbagai mitra.

Saya menyampaikan apresiasi setinggi-tingginya kepada Tim PPK Ormawa DPM FIP Universitas Negeri Surabaya, dosen pendamping, Pemerintah Desa Ngemboh, serta seluruh pihak yang telah memberikan dukungan dan berkolaborasi dalam mewujudkan program ini.

Semoga website ini menjadi sarana berbagi informasi, memperkuat kolaborasi, serta memberikan manfaat yang berkelanjutan bagi masyarakat. Mari terus melangkah dengan ilmu, berkarya dengan integritas, dan mengabdi dengan sepenuh hati demi terwujudnya masyarakat maritim yang mandiri, inovatif, dan berkelanjutan.

Wassalamu’alaikum Warahmatullahi Wabarakatuh.',
                'urutan' => 4,
            ],

            [
                'nama' => 'Firyal Amelia Mufidah',
                'jabatan' => 'Ketua Pelaksana',
                'foto' => 'sambutan/Firyal Amelia Mufidah.JPG',
                'isi_sambutan' => 'Assalamu’alaikum Warahmatullahi Wabarakatuh.

Puji syukur ke hadirat Allah SWT atas segala rahmat dan karunia-Nya sehingga Program Penguatan Kapasitas Organisasi Kemahasiswaan (PPK Ormawa) DPM FIP Universitas Negeri Surabaya dapat terlaksana dengan baik.

Perkenalkan, saya Firyal Amelia Mufidah selaku Ketua Tim PPK Ormawa DPM FIP Universitas Negeri Surabaya. Melalui website Smart Maritime Community Ngemboh ini, kami ingin menghadirkan media informasi yang tidak hanya mendokumentasikan seluruh rangkaian program, tetapi juga menjadi ruang kolaborasi dan inspirasi bagi masyarakat luas.

Program Long-Econ (Longline Economy Empowerment) lahir dari keyakinan bahwa setiap potensi lokal memiliki nilai yang dapat terus dikembangkan. Bersama masyarakat Desa Ngemboh, kami berupaya mengoptimalkan potensi kerang hijau melalui inovasi, pemberdayaan ekonomi, pemanfaatan limbah yang berkelanjutan, serta penguatan kapasitas masyarakat melalui pembentukan Smart Maritime Community.

Kami menyadari bahwa keberhasilan sebuah program tidak dapat dicapai tanpa adanya sinergi dari berbagai pihak. Oleh karena itu, kami menyampaikan rasa terima kasih yang sebesar-besarnya kepada Universitas Negeri Surabaya, dosen pendamping, Pemerintah Desa Ngemboh, para mitra, serta seluruh masyarakat yang telah menerima, mendukung, dan berpartisipasi dalam setiap proses pelaksanaan program ini.

Semoga program beserta website ini tidak berhenti sebagai dokumentasi kegiatan semata, tetapi menjadi awal dari kolaborasi yang terus tumbuh, menginspirasi, serta memberikan manfaat nyata bagi kemajuan Desa Ngemboh. Mari bersama melangkah untuk mewujudkan masyarakat maritim yang lebih mandiri, inovatif, dan berkelanjutan.

Wassalamu’alaikum Warahmatullahi Wabarakatuh.',
                'urutan' => 5,
            ],
        ];

        foreach ($data as $item) {
            Sambutan::create($item);
        }
    }
}