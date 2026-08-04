@extends('layouts.app')
@section('title', $article->title . ' - Smart Maritim Community Ngemboh')

@section('content')
@php
    $wordCount   = str_word_count(strip_tags($article->content));
    $readingTime = max(1, (int) ceil($wordCount / 200));
    $categoryLabel = $article->category === 'produk' ? 'Produk' : 'Kegiatan';
    $paragraphs = collect(explode("\n\n", strip_tags($article->content)))
        ->map(fn ($p) => trim($p))
        ->filter()
        ->values();
@endphp

<div class="bg-[#F8FAFC] -mx-6 md:-mx-12 px-6 md:px-12 py-10">
    <div class="max-w-3xl mx-auto">

        {{-- Breadcrumb --}}
        <nav class="flex items-left justify-left gap-2 text-sm text-[#64748B] mb-8 flex-wrap text-left">
            <a href="{{ route('articles.index') }}" class="hover:text-brand-blue transition-colors duration-200">Artikel & Berita</a>
            <span class="text-[#CBD5E1]">/</span>
            <span class="text-[#94A3B8]">{{ $article->title }}</span>
        </nav>

        {{-- Title --}}
        <h1 class="text-4xl font-bold text-brand-blue leading-tight mb-6">{{ $article->title }}</h1>

        {{-- Meta info --}}
        <div class="flex flex-wrap items-center gap-6 pb-8 border-b border-[#F1F5F9] mb-8">
            <div class="flex items-center gap-2 text-sm text-[#64748B]">
                <x-heroicon-o-calendar class="w-5 h-5 text-[#3B82F6]" />
                {{ $article->published_at?->translatedFormat('d M Y') }}
            </div>
            <div class="flex items-center gap-2 text-sm text-[#64748B]">
                <x-heroicon-o-tag class="w-5 h-5 text-[#3B82F6]" />
                {{ $categoryLabel }}
            </div>
            <div class="flex items-center gap-2 text-sm text-[#64748B]">
                <x-heroicon-o-clock class="w-5 h-5 text-[#3B82F6]" />
                {{ $readingTime }} Menit Baca
            </div>
        </div>

        {{-- Body --}}
        <div class="space-y-6">
            @foreach($paragraphs as $i => $paragraph)

                @if(Str::startsWith($paragraph, '"') && Str::endsWith($paragraph, '"'))
                    <blockquote class="border-l-[6px] border-[#3B82F6] pl-8 py-1 italic text-xl text-[#334155] leading-relaxed">
                        {{ trim($paragraph, '"') }}
                    </blockquote>
                @else
                    <p class="text-lg leading-[1.6] text-[#475569]">{{ $paragraph }}</p>
                @endif

                @if($i === 1 && $article->thumbnail)
                <img src="{{ Storage::url($article->thumbnail) }}" alt="{{ $article->title }}"
                     class="w-full h-[440px] object-cover rounded-2xl shadow-[0_4px_6px_-1px_rgba(0,0,0,0.1),0_2px_4px_-2px_rgba(0,0,0,0.1)]">
                @endif
            @endforeach
        </div>

        {{-- Back button --}}
        <div class="pt-10 mt-10 border-t border-[#F1F5F9]">
            <a href="{{ route('articles.index') }}"
               class="inline-flex items-center gap-3 px-8 py-3 rounded-full border border-[#E2E8F0] bg-white text-brand-green font-semibold text-sm
                      shadow-[0_1px_2px_rgba(0,0,0,0.05)] transition-all duration-300 hover:bg-brand-green hover:text-white hover:border-brand-green">
                <x-heroicon-o-arrow-left class="w-5 h-5" />
                Kembali ke Daftar Artikel
            </a>
        </div>
    </div>

    {{-- Related Articles --}}
    @if($related->isNotEmpty())
    <div class="max-w-6xl mx-auto mt-24 pt-16 border-t border-[#E2E8F0]">
        <h2 class="text-3xl font-bold text-brand-blue text-center mb-10">Artikel & Berita Terkait</h2>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            @foreach($related as $item)
            <a href="{{ route('articles.show', $item) }}"
               class="group block bg-white border border-[#F1F5F9] rounded-2xl overflow-hidden
                      shadow-[0_4px_20px_-2px_rgba(0,0,0,0.05)] transition-all duration-300 hover:-translate-y-1">
                <div class="relative overflow-hidden">
                    @if($item->thumbnail)
                    <img src="{{ Storage::url($item->thumbnail) }}" class="w-full h-56 object-cover transition-transform duration-500 group-hover:scale-110">
                    @else
                    <div class="w-full h-56 bg-[#F1F5F9]"></div>
                    @endif
                    <span class="absolute top-3 left-3 bg-brand-green text-white text-[11px] font-bold uppercase tracking-wide px-3 py-1 rounded-full">
                        {{ $item->category === 'produk' ? 'Artikel' : 'Berita' }}
                    </span>
                </div>
                <div class="p-6">
                    <h3 class="text-lg font-bold text-[#1E293B] leading-snug line-clamp-2 mb-2 transition-colors duration-300 group-hover:text-brand-blue">
                        {{ $item->title }}
                    </h3>
                    <p class="text-sm text-[#64748B] line-clamp-2">{{ Str::limit(strip_tags($item->content), 90) }}</p>
                </div>
            </a>
            @endforeach
        </div>
    </div>
    @endif
</div>
@endsection