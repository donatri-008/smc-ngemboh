<meta name="description" content="{{ $metaDescription ?? 'Smart Maritim Community Ngemboh — komunitas nelayan yang mengelola informasi lingkungan, data demografi nelayan, produk lokal, dan program pemberdayaan pesisir di Desa Ngemboh.' }}">
<meta name="keywords" content="{{ $metaKeywords ?? 'komunitas nelayan, Ngemboh, maritim, kerang hijau, produk laut, lingkungan pesisir' }}">

{{-- Open Graph (preview link saat dibagikan di WhatsApp/Facebook/dll) --}}
<meta property="og:title" content="{{ $metaTitle ?? 'Smart Maritim Community Ngemboh' }}">
<meta property="og:description" content="{{ $metaDescription ?? 'Komunitas nelayan Ngemboh — info lingkungan, produk lokal, dan program pemberdayaan pesisir.' }}">
<meta property="og:type" content="website">
<meta property="og:url" content="{{ url()->current() }}">
<meta property="og:image" content="{{ $metaImage ?? asset('assets/logo/utama/Logo SMC.png') }}">
<meta property="og:site_name" content="Smart Maritim Community Ngemboh">

{{-- Twitter Card --}}
<meta name="twitter:card" content="summary_large_image">
<meta name="twitter:title" content="{{ $metaTitle ?? 'Smart Maritim Community Ngemboh' }}">
<meta name="twitter:description" content="{{ $metaDescription ?? 'Komunitas nelayan Ngemboh — info lingkungan, produk lokal, dan program pemberdayaan pesisir.' }}">
<meta name="twitter:image" content="{{ $metaImage ?? asset('assets/logo/utama/Logo SMC.png') }}">

<link rel="canonical" href="{{ url()->current() }}">