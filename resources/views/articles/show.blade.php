@extends('layouts.app')
@section('title', $article->title . ' - Smart Maritim Community Ngemboh')

@section('content')
@php
    $paragraphs = collect(explode("\n\n", strip_tags($article->content)))
        ->map(fn ($p) => trim($p))
        ->filter()
        ->values();
@endphp

<div class="bg-[#F8FAFC] py-8 sm:py-10">
    <div class="px-4 sm:px-6 md:px-12">
    <div class="max-w-3xl mx-auto">

        {{-- Breadcrumb --}}
        <nav class="flex items-center gap-2 text-xs sm:text-sm text-[#64748B] mb-6 sm:mb-8 flex-wrap">
            <a href="{{ route('articles.index') }}" class="shrink-0 hover:text-brand-blue transition-colors duration-200">Artikel & Berita</a>
            <span class="text-[#CBD5E1] shrink-0">/</span>
            <span class="text-[#94A3B8] line-clamp-1 min-w-0 break-words">{{ $article->title }}</span>
        </nav>

        {{-- Kategori & Tanggal --}}
        <div class="flex flex-wrap items-center gap-3 mb-4">
            <span class="bg-brand-green text-white text-[10px] sm:text-[11px] font-bold uppercase tracking-wide px-3 py-1 rounded-full shrink-0">
                {{ $article->category === 'produk' ? 'Artikel' : 'Berita' }}
            </span>
            <p class="text-xs sm:text-sm text-[#64748B]">
                {{ $article->published_at?->translatedFormat('d F Y') }}
            </p>
        </div>

        {{-- Title --}}
        <h1 class="text-2xl sm:text-3xl md:text-4xl font-bold text-brand-blue leading-tight mb-5 sm:mb-6 break-words">
            {{ $article->title }}
        </h1>

        {{-- Thumbnail --}}
        @if($article->thumbnail)
        <img src="{{ Storage::url($article->thumbnail) }}" alt="{{ $article->title }}"
            class="w-full h-56 sm:h-72 md:h-[400px] object-cover transition-transform duration-300 group-hover:scale-105 rounded-2xl shadow-[0_4px_6px_-1px_rgba(0,0,0,0.1),0_2px_4px_-2px_rgba(0,0,0,0.1)] mb-6 sm:mb-8">
        @endif

        {{-- Galeri Gambar --}}
        @if(!empty($article->gallery))
        <div class="grid grid-cols-2 sm:grid-cols-3 gap-3 sm:gap-4 mb-6 sm:mb-8">
            @foreach($article->gallery as $path)
            <a href="{{ Storage::url($path) }}" target="_blank" class="block rounded-xl overflow-hidden group">
                <img src="{{ Storage::url($path) }}" alt="Galeri {{ $article->title }}"
                    class="w-full h-28 sm:h-36 md:h-40 object-cover transition-transform duration-300 group-hover:scale-105">
            </a>
            @endforeach
        </div>
        @endif

        {{-- Body --}}
        <div class="space-y-4 sm:space-y-6">
            @forelse($paragraphs as $paragraph)
                <p class="text-base sm:text-lg leading-[1.6] sm:leading-[1.7] text-[#475569] break-words">{{ $paragraph }}</p>
            @empty
                <x-ui.empty-state
                    icon="document-text"
                    title="Konten Belum Tersedia"
                    message="Artikel ini belum memiliki isi konten." />
            @endforelse
        </div>

        {{-- Back button --}}
        <div class="pt-8 sm:pt-10 mt-8 sm:mt-10 border-t border-[#F1F5F9]">
            <a href="{{ route('articles.index') }}" aria-label="Kembali ke Artikel & Berita"
               class="inline-flex items-center gap-2 sm:gap-3 px-6 sm:px-8 py-2.5 sm:py-3 rounded-full border border-[#E2E8F0] bg-white text-brand-green font-semibold text-xs sm:text-sm
                      shadow-[0_1px_2px_rgba(0,0,0,0.05)] transition-all duration-300 hover:bg-brand-green hover:text-white hover:border-brand-green">
                <x-heroicon-o-arrow-left class="w-4 h-4 sm:w-5 sm:h-5 shrink-0" />
                <span class="whitespace-nowrap">Kembali ke Artikel & Berita</span>
            </a>
        </div>
    </div>

    {{-- Artikel Terkait --}}
    <div class="max-w-6xl mx-auto mt-16 sm:mt-24 pt-10 sm:pt-16 border-t border-[#E2E8F0]">
        <h2 class="text-2xl sm:text-3xl font-bold text-brand-blue text-center mb-8 sm:mb-10 break-words">Artikel Lainnya</h2>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-5 sm:gap-6 lg:gap-8">
            @forelse($related as $item)
            <a href="{{ route('articles.show', $item) }}"
               class="group block bg-white border border-[#F1F5F9] rounded-2xl overflow-hidden
                      shadow-[0_4px_20px_-2px_rgba(0,0,0,0.05)] transition-all duration-300 hover:-translate-y-1">
                <div class="relative overflow-hidden">
                    @if($item->thumbnail)
                    <img src="{{ Storage::url($item->thumbnail) }}" alt="{{ $article->title }}" class="w-full h-48 sm:h-52 lg:h-56 object-cover transition-transform duration-500 group-hover:scale-110">
                    @else
                    <div class="w-full h-48 sm:h-52 lg:h-56 bg-[#F1F5F9]"></div>
                    @endif
                </div>
                <div class="p-5 sm:p-6">
                    <h3 class="text-base sm:text-lg font-bold text-[#1E293B] leading-snug line-clamp-2 mb-2 transition-colors duration-300 group-hover:text-brand-blue break-words">
                        {{ $item->title }}
                    </h3>
                    <p class="text-sm text-[#64748B] line-clamp-2">{{ Str::limit(strip_tags($item->content), 90) }}</p>
                </div>
            </a>
            @empty
                <x-ui.empty-state
                    icon="rectangle-stack"
                    title="Belum Ada Artikel Terkait"
                    message="Belum ada artikel lain dalam kategori yang sama." />
            @endforelse
        </div>
    </div>
    </div>
</div>
@endsection