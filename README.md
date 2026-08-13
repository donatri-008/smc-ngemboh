# Smart Maritim Community Ngemboh (SMC Ngemboh)

Platform komunitas berbasis web untuk Desa Ngemboh, sebuah desa pesisir nelayan. Aplikasi ini menjadi wadah digital untuk publikasi artikel & berita, data demografi nelayan, informasi lingkungan, profil tim/organisasi, katalog produk, serta legalitas komunitas — dilengkapi dashboard admin untuk mengelola seluruh konten.

## Tentang Proyek

Smart Maritim Community Ngemboh adalah aplikasi web yang dibangun untuk mendukung transparansi informasi dan branding digital komunitas maritim di Desa Ngemboh. Aplikasi terdiri dari dua sisi utama:

- **Halaman publik** — beranda, artikel & berita, data & informasi (demografi nelayan, info lingkungan), belanja/produk, dan halaman "Tentang Kami" (sejarah, visi-misi, filosofi lambang, profil tim, program kerja).
- **Dashboard admin** — panel pengelolaan konten untuk artikel, produk, data demografis, info lingkungan, sertifikat & legalitas, profil tim, dan mitra.

## Fitur Utama

- 📰 **Manajemen Artikel & Berita** — CRUD artikel dengan kategori (berita kegiatan & artikel produk), thumbnail, galeri gambar, dan pencarian.
- 👥 **Manajemen Profil Tim** — pengelolaan anggota tim per kelompok (BPH, Penanggung Jawab, PPK Ormawa) lengkap dengan foto (otomatis dikoreksi orientasinya berdasarkan EXIF) dan urutan tampilan.
- 📊 **Data Demografis Nelayan** — visualisasi dan pengelolaan data statistik nelayan komunitas.
- 🌊 **Info Lingkungan** — publikasi informasi terkait kondisi lingkungan pesisir.
- 🛒 **Belanja/Produk** — katalog produk komunitas dengan alur checkout terintegrasi WhatsApp.
- 📜 **Sertifikat & Legalitas** — dokumentasi legalitas resmi komunitas.
- 🤝 **Mitra** — pengelolaan daftar mitra/kolaborator komunitas.
- 🎨 **Desain Neumorphic** — antarmuka modern dengan gaya neumorphism (soft UI), responsif di berbagai perangkat.
- ⚡ **Reaktif tanpa reload penuh** — interaksi CRUD, pencarian, dan pagination berjalan mulus lewat Livewire.

## Tech Stack

| Kategori | Teknologi |
|---|---|
| Backend | [Laravel](https://laravel.com) |
| Frontend Interaktif | [Livewire 3](https://livewire.laravel.com), [Alpine.js](https://alpinejs.dev) |
| Styling | [Tailwind CSS](https://tailwindcss.com) (dengan sistem desain neumorphic kustom) |
| Templating | Blade |
| Build Tool | [Vite](https://vitejs.dev) |
| Image Processing | Intervention Image (optimasi & koreksi orientasi EXIF) |
| Testing | PHPUnit |

## Struktur Proyek

```
app/
├── Http/Controllers/            # Controller halaman publik
├── Livewire/Admin/               # Komponen Livewire dashboard admin
├── Models/                       # Eloquent model
└── Traits/OptimizesImages.php    # Optimasi & koreksi EXIF foto

resources/
├── css/
├── js/
└── views/
    ├── about/
    │   ├── partials/
    │   │   ├── kontak.blade.php
    │   │   ├── legalities.blade.php
    │   │   ├── partners.blade.php
    │   │   ├── programs.blade.php
    │   │   ├── sambutan.blade.php
    │   │   ├── sejarah.blade.php
    │   │   └── team.blade.php
    │   └── index.blade.php
    ├── articles/
    │   ├── index.blade.php
    │   └── show.blade.php
    ├── auth/
    ├── components/
    │   └── ui/                   # Komponen UI reusable (badge, button, card, empty-state, stat-card, dll.)
    ├── demographic/index.blade.php
    ├── environment/index.blade.php
    ├── errors/                   # 403, 404, 500
    ├── home/index.blade.php
    ├── layouts/                  # admin, app, guest, navigation
    ├── livewire/admin/           # Semua komponen manager admin
    │                             # (article, demographic, environment,
    │                             #  legality, partner, product, statistic,
    │                             #  team, dashboard-overview)
    ├── partials/                 # navbar, footer, flash-messages, seo-meta, admin-sidebar-content, dll.
    ├── programs/show.blade.php
    ├── shop/                     # cart, index, show
    ├── vendor/
    ├── dashboard.blade.php
    ├── sitemap.blade.php
    └── welcome.blade.php

routes/
├── auth.php
├── console.php
└── web.php

```

## Desain & UI

Proyek ini mengikuti sistem desain neumorphic yang selaras dengan mockup Figma, dengan token warna dan shadow yang konsisten, contohnya:

- Warna aksen: `#2681FA` (brand blue), `#4CC71C` (brand green), `#F6F9FF` (background)
- Shadow neumorphic: `6px 6px 12px #BABECC` dikombinasikan dengan highlight putih untuk efek soft UI
- Layout responsif dengan pendekatan mobile-first (breakpoint `sm`, `md`, `lg` dari Tailwind)
