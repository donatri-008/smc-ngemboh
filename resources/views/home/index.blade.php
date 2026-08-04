@extends('layouts.app')
@section('title', 'Beranda - Smart Maritim Community Ngemboh')

@section('content')

{{-- Hero --}}
<section class="px-6 md:px-12 py-16">
    <div class="max-w-6xl mx-auto grid grid-cols-1 md:grid-cols-2 gap-10 items-end">
        <div class="flex flex-col gap-6">
            <h1 class="text-5xl font-bold text-brand-blue leading-tight tracking-tight">
                Membangun Masa Depan Maritim yang Cerdas & Berkelanjutan
            </h1>
            <p class="text-ink max-w-md">
                Komunitas nelayan Ngemboh bertransformasi dengan teknologi dan kolaborasi untuk kesejahteraan bersama. Kami menghadirkan solusi inovatif untuk ekosistem pesisir yang tangguh.
            </p>
            <div class="flex items-center gap-4">
                <a href="{{ route('shop.index') }}"
                   class="bg-neu shadow-neu-out rounded-3xl px-8 py-3 text-lg font-semibold text-brand-green border-2 border-transparent
                          transition-all duration-300 ease-out
                          hover:scale-105 hover:bg-brand-green hover:text-white hover:shadow-neu-in
                          active:scale-95 active:shadow-neu-in">
                    Lihat Produk
                </a>
                <a href="{{ route('articles.index') }}"
                   class="bg-neu shadow-neu-in rounded-3xl px-8 py-3 text-lg font-semibold text-brand-green opacity-80
                          transition-all duration-300 ease-out
                          hover:scale-105 hover:opacity-100 hover:bg-brand-blue hover:text-white
                          active:scale-95">
                    Baca Berita
                </a>
            </div>
        </div>

        <div class="bg-neu shadow-neu-out rounded-[40px] p-3 transition-transform duration-500 ease-out hover:scale-[1.015]">
            {{-- ganti src ini dengan foto komunitas asli, taruh di public/images/ --}}
            <img src="{{ asset('images/hero-komunitas.jpg') }}" alt="Kolaborasi Komunitas" class="w-full h-[400px] object-cover rounded-[32px]">
        </div>
    </div>
</section>

{{-- Stats --}}
<section class="bg-neu py-8">
    <div class="max-w-6xl mx-auto px-6 md:px-12">
        <div class="grid grid-cols-1 sm:grid-cols-3 gap-6">
            @foreach([
                ['icon' => 'users', 'value' => $totalMembers . '+', 'label' => 'Anggota Aktif'],
                ['icon' => 'share', 'value' => $totalPrograms, 'label' => 'Program Pemberdayaan'],
                ['icon' => 'computer-desktop', 'value' => $totalProducts . '+', 'label' => 'Produk Lokal Unggulan'],
            ] as $stat)
            <div class="group bg-neu shadow-neu-in rounded-2xl p-6 flex flex-col items-center cursor-default
                        transition-all duration-300 ease-out hover:scale-[1.03] hover:bg-brand-green/5">
                <x-dynamic-component :component="'heroicon-o-' . $stat['icon']" class="w-9 h-9 text-brand-green mb-2 transition-colors duration-300" />
                <p class="text-3xl font-bold text-brand-green transition-colors duration-300">{{ $stat['value'] }}</p>
                <p class="text-lg font-semibold text-ink mt-1 transition-colors duration-300 group-hover:text-brand-blue">{{ $stat['label'] }}</p>
            </div>
            @endforeach
        </div>
    </div>
</section>

{{-- Artikel Terbaru --}}
<section class="max-w-6xl mx-auto px-6 md:px-12 py-16">
    <div class="flex items-end justify-between mb-8">
        <div>
            <h2 class="text-3xl font-bold text-brand-blue">Artikel & Berita Terbaru</h2>
            <p class="text-ink text-base mt-1">Wawasan dan kabar terkini dari pesisir Ngemboh.</p>
        </div>
        <a href="{{ route('articles.index') }}"
           class="hidden sm:inline-flex items-center gap-2 bg-brand-green shadow-neu-out rounded-full px-6 py-2 text-base font-bold text-white
                  transition-all duration-300 ease-out hover:scale-105 hover:bg-brand-blue active:scale-95">
            Semua Berita <x-heroicon-o-arrow-right class="w-4 h-4" />
        </a>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
        @forelse($latestArticles as $article)
        <a href="{{ route('articles.show', $article) }}"
           class="group block bg-neu rounded-2xl overflow-hidden shadow-neu-out
                  transition-all duration-300 ease-out hover:-translate-y-1 hover:bg-brand-blue/5 active:scale-[0.98] active:shadow-neu-in cursor-pointer">
            <div class="relative overflow-hidden">
                @if($article->thumbnail)
                <img src="{{ Storage::url($article->thumbnail) }}" class="w-full h-44 object-cover transition-transform duration-500 ease-out group-hover:scale-110">
                @else
                <div class="w-full h-44 bg-neu-alt"></div>
                @endif
                <span class="absolute top-3 left-3 bg-brand-green text-white text-[11px] font-bold uppercase tracking-wide px-3 py-1 rounded-full">
                    {{ $article->category === 'produk' ? 'Artikel' : 'Berita' }}
                </span>
            </div>
            <div class="p-5">
                <p class="text-[13px] font-semibold text-ink tracking-wide">{{ $article->published_at?->translatedFormat('d M Y') }}</p>
                <p class="font-semibold text-brand-blue text-xl mt-2 line-clamp-2 transition-colors duration-300 group-hover:text-brand-green">{{ $article->title }}</p>
                <p class="text-base text-ink mt-1 line-clamp-2">{{ Str::limit(strip_tags($article->content), 90) }}</p>
            </div>
        </a>
        @empty
        <x-ui.empty-state />
        @endforelse
    </div>
</section>

{{-- Produk Unggulan --}}
<section class="bg-neu-alt py-16">
    <div class="max-w-6xl mx-auto px-6 md:px-12">
        <div class="text-center max-w-2xl mx-auto mb-10">
            <h2 class="text-3xl font-bold text-brand-blue">Produk Unggulan Kami</h2>
            <p class="text-ink text-base mt-2">Dukung ekonomi lokal dengan membeli produk berkualitas tinggi hasil olahan langsung komunitas kami.</p>
        </div>

        <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
            @forelse($featuredProducts as $product)
            <div class="group bg-neu shadow-neu-out rounded-2xl p-3
                        transition-all duration-300 ease-out hover:-translate-y-1 hover:bg-brand-blue/5 active:scale-[0.98]">
                <a href="{{ route('shop.show', $product) }}" class="block overflow-hidden rounded-2xl">
                    @if($product->gambar)
                    <img src="{{ Storage::url($product->gambar) }}" class="w-full h-40 object-cover rounded-2xl bg-white transition-transform duration-500 ease-out group-hover:scale-110">
                    @else
                    <div class="w-full h-40 bg-white rounded-2xl"></div>
                    @endif
                </a>
                <div class="px-2 pt-3 space-y-1">
                    <p class="text-base text-dark truncate transition-colors duration-300 group-hover:text-brand-blue">{{ $product->nama }}</p>
                    <p class="text-base font-bold text-brand-blue pb-2">Rp{{ number_format($product->harga, 0, ',', '.') }}</p>
                    <form action="{{ route('cart.add', $product) }}" method="POST">
                        @csrf
                        <button class="w-full bg-neu shadow-neu-in rounded-xl py-2 text-sm font-semibold text-brand-green
                                       transition-all duration-300 ease-out hover:bg-brand-green hover:text-white active:scale-95">
                            Tambah
                        </button>
                    </form>
                </div>
            </div>
            @empty
            <x-ui.empty-state message="Belum ada produk." />
            @endforelse
        </div>
    </div>
</section>

{{-- Program Strategis --}}
<section class="max-w-6xl mx-auto px-6 md:px-12 py-16">
    <div class="mb-8">
        <h2 class="text-3xl font-bold text-brand-blue">Program Strategis Kami</h2>
        <p class="text-ink text-base mt-1">Inisiatif yang menggerakkan perubahan di komunitas.</p>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        @php $mainProgram = $programs->first(); $otherPrograms = $programs->slice(1, 2); @endphp

        @if($mainProgram)
        <div class="group bg-neu shadow-neu-in rounded-2xl p-10 relative overflow-hidden flex flex-col justify-end min-h-[280px]
                    transition-all duration-300 ease-out hover:scale-[1.01] hover:bg-brand-blue/5">
            <x-heroicon-o-rocket-launch class="w-28 h-28 text-dark opacity-10 absolute top-8 right-8" />
            <h3 class="text-3xl font-bold text-brand-blue relative z-10">{{ $mainProgram->nama }}</h3>
            <p class="text-base text-ink mt-2 max-w-md relative z-10">{{ $mainProgram->deskripsi }}</p>
            <a href="{{ route('about.index') }}"
               class="inline-flex items-center justify-center mt-6 bg-brand-green shadow-neu-out rounded-full px-6 py-3 text-base font-bold text-white w-fit relative z-10
                      transition-all duration-300 ease-out hover:scale-105 hover:bg-brand-blue active:scale-95">
                Pelajari
            </a>
        </div>
        @endif

        <div class="grid grid-rows-2 gap-6">
            @forelse($otherPrograms as $program)
            <div class="group bg-neu shadow-neu-in rounded-2xl p-6 flex items-center gap-4
                        transition-all duration-300 ease-out hover:scale-[1.02] hover:bg-brand-blue/5 cursor-default">
                <div class="w-14 h-14 rounded-2xl bg-brand-green shadow-neu-out flex items-center justify-center shrink-0
                            transition-colors duration-300 group-hover:bg-brand-blue">
                    <x-dynamic-component :component="'heroicon-o-' . ($program->icon ?: 'sparkles')" class="w-6 h-6 text-white" />
                </div>
                <div>
                    <p class="font-semibold text-brand-blue text-xl">{{ $program->nama }}</p>
                    <p class="text-sm text-ink mt-1">{{ $program->deskripsi }}</p>
                </div>
            </div>
            @empty
            <x-ui.empty-state message="Belum ada program lain." />
            @endforelse
        </div>
    </div>
</section>

@endsection