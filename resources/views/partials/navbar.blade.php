<nav x-data="{ mobileOpen: false, berandaOpen: false, aboutOpen: false }" class="bg-neu px-6 md:px-12 py-3 flex items-center justify-between sticky top-0 z-40">
    <a href="{{ route('home') }}" class="flex items-center shrink-0">
        <img src="{{ asset('assets/logo/utama/Logo SMC.webp') }}" alt="Smart Maritim Community Ngemboh" class="h-10 w-10 md:h-12 md:w-12 object-contain">
    </a>

    {{-- Menu desktop --}}
    <div class="hidden md:flex items-center gap-6 lg:gap-8 text-sm lg:text-base">

        {{-- Beranda + dropdown --}}
        <div class="relative" x-on:mouseenter="berandaOpen = true" x-on:mouseleave="berandaOpen = false">
            <a href="{{ route('home') }}"
                class="flex items-center gap-1 pb-1 transition-colors duration-150 {{ request()->routeIs('home') ? 'text-brand-blue font-bold border-b-2 border-brand-blue' : 'text-ink font-normal hover:text-brand-blue' }}">
                Beranda
                <x-heroicon-o-chevron-down class="w-3.5 h-3.5 transition-transform duration-200" x-bind:class="berandaOpen ? 'rotate-180' : ''" />
            </a>
            <div x-show="berandaOpen" x-cloak
                x-transition:enter="transition ease-out duration-150"
                x-transition:enter-start="opacity-0 -translate-y-1"
                x-transition:enter-end="opacity-100 translate-y-0"
                x-transition:leave="transition ease-in duration-100"
                x-transition:leave-start="opacity-100 translate-y-0"
                x-transition:leave-end="opacity-0 -translate-y-1"
                class="absolute left-0 top-full pt-2 w-56">
                <div class="bg-neu rounded-xl p-2 flex flex-col gap-1">
                    <a href="{{ route('home') }}#artikel-berita" class="px-4 py-2.5 rounded-lg text-sm text-ink hover:bg-white/60 hover:text-brand-blue transition-colors duration-150">Artikel & Berita</a>
                    <a href="{{ route('home') }}#produk-unggulan" class="px-4 py-2.5 rounded-lg text-sm text-ink hover:bg-white/60 hover:text-brand-blue transition-colors duration-150">Produk Unggulan</a>
                    <a href="{{ route('home') }}#program-smc" class="px-4 py-2.5 rounded-lg text-sm text-ink hover:bg-white/60 hover:text-brand-blue transition-colors duration-150">Program SMC</a>
                </div>
            </div>
        </div>

        <a href="{{ route('articles.index') }}"
            class="pb-1 transition-colors duration-150 {{ request()->routeIs('articles.*') ? 'text-brand-blue font-bold border-b-2 border-brand-blue' : 'text-ink font-normal hover:text-brand-blue' }}">
            Artikel & Berita
        </a>
        <a href="{{ route('demographic.index') }}"
            class="pb-1 transition-colors duration-150 {{ request()->routeIs('demographic.*', 'environment.*') ? 'text-brand-blue font-bold border-b-2 border-brand-blue' : 'text-ink font-normal hover:text-brand-blue' }}">
            Data & Informasi
        </a>
        <a href="{{ route('shop.index') }}"
            class="pb-1 transition-colors duration-150 {{ request()->routeIs('shop.*') ? 'text-brand-blue font-bold border-b-2 border-brand-blue' : 'text-ink font-normal hover:text-brand-blue' }}">
            Belanja
        </a>

        {{-- Tentang Kami + dropdown --}}
        <div class="relative" x-on:mouseenter="aboutOpen = true" x-on:mouseleave="aboutOpen = false">
            <a href="{{ route('about.index') }}"
                class="flex items-center gap-1 pb-1 transition-colors duration-150 {{ request()->routeIs('about.*') ? 'text-brand-blue font-bold border-b-2 border-brand-blue' : 'text-ink font-normal hover:text-brand-blue' }}">
                Tentang Kami
                <x-heroicon-o-chevron-down class="w-3.5 h-3.5 transition-transform duration-200" x-bind:class="aboutOpen ? 'rotate-180' : ''" />
            </a>
            <div x-show="aboutOpen" x-cloak
                x-transition:enter="transition ease-out duration-150"
                x-transition:enter-start="opacity-0 -translate-y-1"
                x-transition:enter-end="opacity-100 translate-y-0"
                x-transition:leave="transition ease-in duration-100"
                x-transition:leave-start="opacity-100 translate-y-0"
                x-transition:leave-end="opacity-0 -translate-y-1"
                class="absolute right-0 top-full pt-2 w-56">
                <div class="bg-neu rounded-xl p-2 flex flex-col gap-1">
                    <a href="{{ route('about.index') }}#sambutan" class="px-4 py-2.5 rounded-lg text-sm text-ink hover:bg-white/60 hover:text-brand-blue transition-colors duration-150">Sambutan</a>
                    <a href="{{ route('about.index') }}#jejak-langkah" class="px-4 py-2.5 rounded-lg text-sm text-ink hover:bg-white/60 hover:text-brand-blue transition-colors duration-150">Jejak Langkah Kami</a>
                    <a href="{{ route('about.index') }}#visi-misi" class="px-4 py-2.5 rounded-lg text-sm text-ink hover:bg-white/60 hover:text-brand-blue transition-colors duration-150">Visi & Misi</a>
                    <a href="{{ route('about.index') }}#filosofi-lambang" class="px-4 py-2.5 rounded-lg text-sm text-ink hover:bg-white/60 hover:text-brand-blue transition-colors duration-150">Filosofi Lambang</a>
                    <a href="{{ route('about.index') }}#program-kerja" class="px-4 py-2.5 rounded-lg text-sm text-ink hover:bg-white/60 hover:text-brand-blue transition-colors duration-150">Program Kerja</a>
                    <a href="{{ route('about.index') }}#legalitas" class="px-4 py-2.5 rounded-lg text-sm text-ink hover:bg-white/60 hover:text-brand-blue transition-colors duration-150">Sertifikasi & Legalitas</a>
                    <a href="{{ route('about.index') }}#mitra" class="px-4 py-2.5 rounded-lg text-sm text-ink hover:bg-white/60 hover:text-brand-blue transition-colors duration-150">Mitra</a>
                    <a href="{{ route('about.index') }}#profil-tim" class="px-4 py-2.5 rounded-lg text-sm text-ink hover:bg-white/60 hover:text-brand-blue transition-colors duration-150">Profil Tim</a>
                    <a href="{{ route('about.index') }}#kontak" class="px-4 py-2.5 rounded-lg text-sm text-ink hover:bg-white/60 hover:text-brand-blue transition-colors duration-150">Kontak</a>
                </div>
            </div>
        </div>
    </div>

    {{-- Kanan: cart + hamburger (mobile) --}}
    <div class="flex items-center gap-3">
        <a href="{{ route('cart.index') }}" aria-label="Lihat keranjang belanja"
            x-data="{ count: {{ (int) ($cartCount ?? 0) }} }"
            x-on:cart-updated.window="count = $event.detail.count"
            class="relative w-9 h-9 rounded-full bg-brand-green flex items-center justify-center shrink-0 transition-transform duration-150 hover:scale-105 active:scale-95">
            <x-heroicon-o-shopping-cart class="w-5 h-5 text-white" />

            <span x-show="count > 0" x-cloak x-text="count > 99 ? '99+' : count"
                  class="absolute -top-1.5 -right-1.5 min-w-[18px] h-[18px] px-1 rounded-full bg-red-500 text-white text-[10px] font-bold flex items-center justify-center leading-none">
            </span>
        </a>

        {{-- Tombol hamburger, hanya muncul di mobile --}}
        <button
            x-on:click="mobileOpen = !mobileOpen"
            class="md:hidden w-9 h-9 rounded-full shadow-[4px_4px_8px_#D1D9E6,-4px_-4px_8px_#FFFFFF] bg-neu flex items-center justify-center shrink-0 transition-transform duration-150 active:scale-95"
            aria-label="Buka menu navigasi">
            <svg x-show="!mobileOpen" class="w-5 h-5 text-brand-blue" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
            </svg>
            <svg x-show="mobileOpen" x-cloak class="w-5 h-5 text-brand-blue" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
            </svg>
        </button>
    </div>

    {{-- Menu mobile (dropdown/accordion) --}}
    <div x-show="mobileOpen"
        x-cloak
        x-on:click.outside="mobileOpen = false"
        x-transition:enter="transition ease-out duration-200"
        x-transition:enter-start="opacity-0 -translate-y-2"
        x-transition:enter-end="opacity-100 translate-y-0"
        x-transition:leave="transition ease-in duration-150"
        x-transition:leave-start="opacity-100 translate-y-0"
        x-transition:leave-end="opacity-0 -translate-y-2"
        class="absolute top-full left-0 right-0 md:hidden bg-neu mx-4 mt-2 rounded-2xl p-4 flex flex-col gap-1 text-base z-50 max-h-[80vh] overflow-y-auto">

        {{-- Beranda + accordion --}}
        <div x-data="{ open: false }">
            <div class="flex items-center justify-between px-4 py-3 rounded-xl border-l-4 transition-all duration-150 {{ request()->routeIs('home') ? 'bg-brand-blue/10 border-brand-blue text-brand-blue font-bold' : 'border-transparent text-ink font-normal' }}">
                <a href="{{ route('home') }}" class="flex-1">Beranda</a>
                <button x-on:click="open = !open" class="p-1" aria-label="Buka submenu Beranda">
                    <x-heroicon-o-chevron-down class="w-4 h-4 transition-transform duration-200" x-bind:class="open ? 'rotate-180' : ''" />
                </button>
            </div>
            <div x-show="open" x-cloak
                x-transition:enter="transition ease-out duration-150"
                x-transition:enter-start="opacity-0 max-h-0"
                x-transition:enter-end="opacity-100 max-h-40"
                class="pl-6 flex flex-col gap-1 mt-1 overflow-hidden">
                <a href="{{ route('home') }}#artikel-berita" x-on:click="mobileOpen = false" class="px-4 py-2 text-sm text-ink hover:text-brand-blue">Artikel & Berita</a>
                <a href="{{ route('home') }}#produk-unggulan" x-on:click="mobileOpen = false" class="px-4 py-2 text-sm text-ink hover:text-brand-blue">Produk Unggulan</a>
                <a href="{{ route('home') }}#program-smc" x-on:click="mobileOpen = false" class="px-4 py-2 text-sm text-ink hover:text-brand-blue">Program SMC</a>
            </div>
        </div>

        <a href="{{ route('articles.index') }}"
            class="flex items-center justify-between px-4 py-3 rounded-xl border-l-4 transition-all duration-150 {{ request()->routeIs('articles.*') ? 'bg-brand-blue/10 border-brand-blue text-brand-blue font-bold' : 'border-transparent text-ink font-normal hover:bg-white/50 hover:text-brand-blue' }}">
            <span>Artikel & Berita</span>
        </a>
        <a href="{{ route('demographic.index') }}"
            class="flex items-center justify-between px-4 py-3 rounded-xl border-l-4 transition-all duration-150 {{ request()->routeIs('demographic.*', 'environment.*') ? 'bg-brand-blue/10 border-brand-blue text-brand-blue font-bold' : 'border-transparent text-ink font-normal hover:bg-white/50 hover:text-brand-blue' }}">
            <span>Data & Informasi</span>
        </a>
        <a href="{{ route('shop.index') }}"
            class="flex items-center justify-between px-4 py-3 rounded-xl border-l-4 transition-all duration-150 {{ request()->routeIs('shop.*') ? 'bg-brand-blue/10 border-brand-blue text-brand-blue font-bold' : 'border-transparent text-ink font-normal hover:bg-white/50 hover:text-brand-blue' }}">
            <span>Belanja</span>
        </a>

        {{-- Tentang Kami + accordion --}}
        <div x-data="{ open: false }">
            <div class="flex items-center justify-between px-4 py-3 rounded-xl border-l-4 transition-all duration-150 {{ request()->routeIs('about.*') ? 'bg-brand-blue/10 border-brand-blue text-brand-blue font-bold' : 'border-transparent text-ink font-normal' }}">
                <a href="{{ route('about.index') }}" class="flex-1">Tentang Kami</a>
                <button x-on:click="open = !open" class="p-1" aria-label="Buka submenu Tentang Kami">
                    <x-heroicon-o-chevron-down class="w-4 h-4 transition-transform duration-200" x-bind:class="open ? 'rotate-180' : ''" />
                </button>
            </div>
            <div x-show="open" x-cloak
                x-transition:enter="transition ease-out duration-150"
                x-transition:enter-start="opacity-0 max-h-0"
                x-transition:enter-end="opacity-100 max-h-96"
                class="pl-6 flex flex-col gap-1 mt-1 overflow-hidden">
                <a href="{{ route('about.index') }}#sambutan" x-on:click="mobileOpen = false" class="px-4 py-2 text-sm text-ink hover:text-brand-blue">Sambutan</a>
                <a href="{{ route('about.index') }}#jejak-langkah" x-on:click="mobileOpen = false" class="px-4 py-2 text-sm text-ink hover:text-brand-blue">Jejak Langkah Kami</a>
                <a href="{{ route('about.index') }}#visi-misi" x-on:click="mobileOpen = false" class="px-4 py-2 text-sm text-ink hover:text-brand-blue">Visi & Misi</a>
                <a href="{{ route('about.index') }}#filosofi-lambang" x-on:click="mobileOpen = false" class="px-4 py-2 text-sm text-ink hover:text-brand-blue">Filosofi Lambang</a>
                <a href="{{ route('about.index') }}#program-kerja" x-on:click="mobileOpen = false" class="px-4 py-2 text-sm text-ink hover:text-brand-blue">Program Kerja</a>
                <a href="{{ route('about.index') }}#legalitas" x-on:click="mobileOpen = false" class="px-4 py-2 text-sm text-ink hover:text-brand-blue">Sertifikasi & Legalitas</a>
                <a href="{{ route('about.index') }}#mitra" x-on:click="mobileOpen = false" class="px-4 py-2 text-sm text-ink hover:text-brand-blue">Mitra</a>
                <a href="{{ route('about.index') }}#profil-tim" x-on:click="mobileOpen = false" class="px-4 py-2 text-sm text-ink hover:text-brand-blue">Profil Tim</a>
                <a href="{{ route('about.index') }}#kontak" x-on:click="mobileOpen = false" class="px-4 py-2 text-sm text-ink hover:text-brand-blue">Kontak</a>
            </div>
        </div>
    </div>
</nav>