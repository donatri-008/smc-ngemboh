@php
    $defaultDescription = 'Smart Maritim Community Ngemboh — komunitas nelayan pesisir Desa Ngemboh, Gresik, mengelola info lingkungan, produk lokal, dan program pemberdayaan.';
    $description = $metaDescription ?? $defaultDescription;
    $title = $metaTitle ?? 'Smart Maritim Community Ngemboh';
    $image = $metaImage ?? asset('assets/logo/utama/Logo SMC.webp');
    $type = $metaType ?? 'website';
@endphp

<meta name="description" content="{{ Str::limit($description, 160, '') }}">
<meta name="keywords" content="{{ $metaKeywords ?? 'komunitas nelayan, Ngemboh, maritim, kerang hijau, produk laut, lingkungan pesisir, Gresik' }}">
<meta name="robots" content="index, follow">

{{-- Open Graph (preview link saat dibagikan di WhatsApp/Facebook/dll) --}}
<meta property="og:title" content="{{ $title }}">
<meta property="og:description" content="{{ Str::limit($description, 160, '') }}">
<meta property="og:type" content="{{ $type }}">
<meta property="og:url" content="{{ url()->current() }}">
<meta property="og:image" content="{{ $image }}">
<meta property="og:site_name" content="Smart Maritim Community Ngemboh">
<meta property="og:locale" content="id_ID">

{{-- Twitter Card --}}
<meta name="twitter:card" content="summary_large_image">
<meta name="twitter:title" content="{{ $title }}">
<meta name="twitter:description" content="{{ Str::limit($description, 160, '') }}">
<meta name="twitter:image" content="{{ $image }}">

<link rel="canonical" href="{{ url()->current() }}">