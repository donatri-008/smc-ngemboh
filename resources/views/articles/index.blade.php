@extends('layouts.app')
@section('title', 'Artikel & Berita - Smart Maritim Community Ngemboh')

@section('content')
<div class="max-w-6xl mx-auto px-6 pt-10 pb-16">

    {{-- Header --}}
    <div class="text-center max-w-2xl mx-auto mb-10">
        <h1 class="text-5xl font-bold text-brand-blue tracking-tight">Artikel & Berita Terbaru</h1>
        <p class="text-ink text-base mt-4">
            Temukan informasi terkini seputar kegiatan komunitas, inovasi maritim, dan perkembangan lingkungan di Desa Ngemboh.
        </p>
    </div>

    {{-- Tabs & Search --}}
    <div class="flex flex-col md:flex-row items-center justify-between gap-4 mb-10">
        <div class="bg-neu shadow-neu-in rounded-full p-2 flex items-center gap-2">
            <a href="{{ request()->fullUrlWithQuery(['category' => 'berita_acara']) }}"
               class="px-6 py-2 rounded-full text-lg font-semibold transition-all duration-300
                      {{ request('category', 'berita_acara') === 'berita_acara'
                         ? 'bg-neu shadow-neu-out text-brand-green'
                         : 'shadow-neu-in text-brand-green hover:bg-brand-green hover:text-white' }}">
                Berita Kegiatan
            </a>
            <a href="{{ request()->fullUrlWithQuery(['category' => 'produk']) }}"
               class="px-6 py-2 rounded-full text-lg font-semibold transition-all duration-300
                      {{ request('category') === 'produk'
                         ? 'bg-neu shadow-neu-out text-brand-green'
                         : 'shadow-neu-in text-brand-green hover:bg-brand-green hover:text-white' }}">
                Artikel Produk
            </a>
        </div>

        {{-- Search --}}
        <form action="{{ route('articles.index') }}" method="GET" class="relative w-full md:w-96" x-data>
            <input type="hidden" name="category" value="{{ request('category', 'berita_acara') }}">
            <x-heroicon-o-magnifying-glass class="w-5 h-5 text-brand-green absolute left-4 top-1/2 -translate-y-1/2 pointer-events-none" />
            <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari artikel atau berita..."
                   x-on:input.debounce.500ms="$el.form.submit()"
                   class="w-full bg-neu shadow-neu-in rounded-full pl-12 pr-5 py-3 text-sm italic text-brand-green placeholder-brand-green outline-none border-none focus:ring-0">
        </form>
    </div>

    {{-- Grid Artikel --}}
    <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-12">
        @forelse($articles as $article)
        <a href="{{ route('articles.show', $article) }}"
        class="group bg-neu rounded-2xl overflow-hidden shadow-neu-lg flex flex-col
                transition-all duration-300 hover:-translate-y-1">

            <div class="relative overflow-hidden">
                @if($article->thumbnail)
                <img src="{{ Storage::url($article->thumbnail) }}"
                    class="w-full h-56 object-cover transition-transform duration-500 group-hover:scale-110">
                @else
                <div class="w-full h-56 bg-neu-alt"></div>
                @endif

                <span class="absolute top-3 left-3 bg-brand-green text-white text-[11px] font-bold uppercase tracking-wide px-3 py-1 rounded-full">
                    {{ $article->category === 'produk' ? 'Artikel' : 'Berita' }}
                </span>
            </div>

            <div class="p-6 flex flex-col flex-1">
                <div class="flex items-center gap-2 mb-3">
                    <x-heroicon-o-calendar class="w-4 h-4 text-muted" />
                    <p class="text-[13px] font-semibold text-ink tracking-wide">
                        {{ $article->published_at?->translatedFormat('d M Y') }}
                    </p>
                </div>

                <h3 class="text-xl font-semibold text-dark leading-snug mb-3 line-clamp-2 transition-colors duration-300 group-hover:text-brand-blue">
                    {{ $article->title }}
                </h3>

                <p class="text-base text-ink mb-6 line-clamp-3">
                    {{ Str::limit(strip_tags($article->content), 110) }}
                </p>

                <div class="mt-auto text-center bg-brand-green shadow-neu-out rounded-xl py-3 text-lg font-semibold text-white
                            transition-all duration-300 group-hover:bg-brand-blue">
                    Baca Selengkapnya
                </div>
            </div>

        </a>
        @empty
            <x-ui.empty-state message="Belum ada artikel." />
        @endforelse
    </div>

    {{-- Pagination --}}
    {{ $articles->links('vendor.pagination.neu') }}
</div>
@endsection