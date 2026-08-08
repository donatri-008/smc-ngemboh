@extends('layouts.app')
@section('title', $program->nama . ' - Smart Maritim Community Ngemboh')

@section('content')
@php
<<<<<<< HEAD
    $paragraphs = collect(explode("\n\n", strip_tags($article->content)))
=======
    $paragraphs = collect(explode("\n\n", strip_tags($program->konten)))
>>>>>>> 7c2b0c38c7cbb0458913dc97ac2a87842c5a8228
        ->map(fn ($p) => trim($p))
        ->filter()
        ->values();
@endphp

<div class="bg-[#F8FAFC] -mx-4 sm:-mx-6 md:-mx-12 px-4 sm:px-6 md:px-12 py-8 sm:py-10">
    <div class="max-w-3xl mx-auto">

        {{-- Breadcrumb --}}
<<<<<<< HEAD
        <nav class="flex items-center gap-2 text-xs sm:text-sm text-[#64748B] mb-6 sm:mb-8 flex-wrap">
            <a href="{{ route('articles.index') }}" class="hover:text-brand-blue transition-colors duration-200">Artikel & Berita</a>
            <span class="text-[#CBD5E1]">/</span>
            <span class="text-[#94A3B8] line-clamp-1">{{ $article->title }}</span>
        </nav>

        {{-- Kategori & Tanggal --}}
        <div class="flex flex-wrap items-center gap-3 mb-4">
            <span class="bg-brand-green text-white text-[10px] sm:text-[11px] font-bold uppercase tracking-wide px-3 py-1 rounded-full">
                {{ $article->category === 'produk' ? 'Artikel' : 'Berita' }}
            </span>
            <p class="text-xs sm:text-sm text-[#64748B]">
                {{ $article->published_at?->translatedFormat('d M Y') }}
            </p>
        </div>

        {{-- Title --}}
        <h1 class="text-2xl sm:text-3xl md:text-4xl font-bold text-brand-blue leading-tight mb-5 sm:mb-6">
            {{ $article->title }}
        </h1>

        {{-- Thumbnail --}}
        @if($article->thumbnail)
        <img src="{{ Storage::url($article->thumbnail) }}" alt="{{ $article->title }}"
            class="w-full h-56 sm:h-72 md:h-[400px] object-contain rounded-2xl shadow-[0_4px_6px_-1px_rgba(0,0,0,0.1),0_2px_4px_-2px_rgba(0,0,0,0.1)] mb-6 sm:mb-8">
        @endif

        {{-- Galeri Gambar --}}
        @if(!empty($article->gallery))
        <div class="grid grid-cols-2 sm:grid-cols-3 gap-3 sm:gap-4 mb-6 sm:mb-8">
            @foreach($article->gallery as $path)
            <a href="{{ Storage::url($path) }}" target="_blank" class="block rounded-xl overflow-hidden group">
                <img src="{{ Storage::url($path) }}" alt="Galeri {{ $article->title }}"
                    class="w-full h-28 sm:h-36 md:h-40 object-cover transition-transform duration-300 group-hover:scale-105">
            </a>
=======
        <nav class="flex items-left justify-left gap-2 text-sm text-[#64748B] mb-8 flex-wrap text-left">
            <a href="{{ route('about.index') }}" class="hover:text-brand-blue transition-colors duration-200">Tentang Kami</a>
            <span class="text-[#CBD5E1]">/</span>
            <span class="text-[#94A3B8]">{{ $program->nama }}</span>
        </nav>

        {{-- Title --}}
        <h1 class="text-4xl font-bold text-brand-blue leading-tight mb-6">{{ $program->nama }}</h1>

        {{-- Gambar utama --}}
        @if($program->gambar)
        <img src="{{ asset('assets/Program/' . $program->gambar) }}" alt="{{ $program->nama }}"
             class="w-full h-[400px] object-cover rounded-2xl shadow-[0_4px_6px_-1px_rgba(0,0,0,0.1),0_2px_4px_-2px_rgba(0,0,0,0.1)] mb-8">
        @endif

        {{-- Body --}}
        <div class="space-y-6">
            @foreach($paragraphs as $paragraph)
            <p class="text-lg leading-[1.6] text-[#475569]">{{ $paragraph }}</p>
>>>>>>> 7c2b0c38c7cbb0458913dc97ac2a87842c5a8228
            @endforeach
        </div>
        @endif

        {{-- Body --}}
        <div class="space-y-4 sm:space-y-6">
            @forelse($paragraphs as $paragraph)
                <p class="text-base sm:text-lg leading-[1.6] sm:leading-[1.7] text-[#475569]">{{ $paragraph }}</p>
            @empty
                <x-ui.empty-state
                    icon="document-text"
                    title="Konten Belum Tersedia"
                    message="Artikel ini belum memiliki isi konten." />
            @endforelse
        </div>

        {{-- Back button --}}
<<<<<<< HEAD
        <div class="pt-8 sm:pt-10 mt-8 sm:mt-10 border-t border-[#F1F5F9]">
            <a href="{{ route('articles.index') }}"
               class="inline-flex items-center gap-2 sm:gap-3 px-6 sm:px-8 py-2.5 sm:py-3 rounded-full border border-[#E2E8F0] bg-white text-brand-green font-semibold text-xs sm:text-sm
                      shadow-[0_1px_2px_rgba(0,0,0,0.05)] transition-all duration-300 hover:bg-brand-green hover:text-white hover:border-brand-green">
                <x-heroicon-o-arrow-left class="w-4 h-4 sm:w-5 sm:h-5" />
                Kembali ke Artikel & Berita
=======
        <div class="pt-10 mt-10 border-t border-[#F1F5F9]">
            <a href="{{ route('about.index') }}"
               class="inline-flex items-center gap-3 px-8 py-3 rounded-full border border-[#E2E8F0] bg-white text-brand-green font-semibold text-sm
                      shadow-[0_1px_2px_rgba(0,0,0,0.05)] transition-all duration-300 hover:bg-brand-green hover:text-white hover:border-brand-green">
                <x-heroicon-o-arrow-left class="w-5 h-5" />
                Kembali ke Tentang Kami
>>>>>>> 7c2b0c38c7cbb0458913dc97ac2a87842c5a8228
            </a>
        </div>
    </div>

<<<<<<< HEAD
    {{-- Artikel Terkait --}}
    <div class="max-w-6xl mx-auto mt-16 sm:mt-24 pt-10 sm:pt-16 border-t border-[#E2E8F0]">
        <h2 class="text-2xl sm:text-3xl font-bold text-brand-blue text-center mb-8 sm:mb-10">Artikel Lainnya</h2>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-5 sm:gap-6 lg:gap-8">
            @forelse($related as $item)
            <a href="{{ route('articles.show', $item) }}"
               class="group block bg-white border border-[#F1F5F9] rounded-2xl overflow-hidden
                      shadow-[0_4px_20px_-2px_rgba(0,0,0,0.05)] transition-all duration-300 hover:-translate-y-1">
                <div class="relative overflow-hidden">
                    @if($item->thumbnail)
                    <img src="{{ Storage::url($item->thumbnail) }}" class="w-full h-48 sm:h-52 lg:h-56 object-cover transition-transform duration-500 group-hover:scale-110">
=======
    {{-- Program Terkait --}}
    @if($related->isNotEmpty())
    <div class="max-w-6xl mx-auto mt-24 pt-16 border-t border-[#E2E8F0]">
        <h2 class="text-3xl font-bold text-brand-blue text-center mb-10">Program Lainnya</h2>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            @foreach($related as $item)
            <a href="{{ route('program.show', $item) }}"
               class="group block bg-white border border-[#F1F5F9] rounded-2xl overflow-hidden
                      shadow-[0_4px_20px_-2px_rgba(0,0,0,0.05)] transition-all duration-300 hover:-translate-y-1">
                <div class="relative overflow-hidden">
                    @if($item->gambar)
                    <img src="{{ asset('assets/Program/' . $item->gambar) }}" class="w-full h-56 object-cover transition-transform duration-500 group-hover:scale-110">
>>>>>>> 7c2b0c38c7cbb0458913dc97ac2a87842c5a8228
                    @else
                    <div class="w-full h-48 sm:h-52 lg:h-56 bg-[#F1F5F9]"></div>
                    @endif
                </div>
<<<<<<< HEAD
                <div class="p-5 sm:p-6">
                    <h3 class="text-base sm:text-lg font-bold text-[#1E293B] leading-snug line-clamp-2 mb-2 transition-colors duration-300 group-hover:text-brand-blue">
                        {{ $item->title }}
=======
                <div class="p-6">
                    <h3 class="text-lg font-bold text-[#1E293B] leading-snug line-clamp-2 mb-2 transition-colors duration-300 group-hover:text-brand-blue">
                        {{ $item->nama }}
>>>>>>> 7c2b0c38c7cbb0458913dc97ac2a87842c5a8228
                    </h3>
                    <p class="text-sm text-[#64748B] line-clamp-2">{{ $item->deskripsi }}</p>
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
@endsection
