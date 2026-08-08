@extends('layouts.app')
@section('title', $program->nama . ' - Smart Maritim Community Ngemboh')

@section('content')
@php
    $paragraphs = collect(explode("\n\n", strip_tags($program->konten)))
        ->map(fn ($p) => trim($p))
        ->filter()
        ->values();
@endphp

<div class="bg-[#F8FAFC] -mx-6 md:-mx-12 px-6 md:px-12 py-10">
    <div class="max-w-3xl mx-auto">

        {{-- Breadcrumb --}}
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
            @endforeach
        </div>

        {{-- Back button --}}
        <div class="pt-10 mt-10 border-t border-[#F1F5F9]">
            <a href="{{ route('about.index') }}"
               class="inline-flex items-center gap-3 px-8 py-3 rounded-full border border-[#E2E8F0] bg-white text-brand-green font-semibold text-sm
                      shadow-[0_1px_2px_rgba(0,0,0,0.05)] transition-all duration-300 hover:bg-brand-green hover:text-white hover:border-brand-green">
                <x-heroicon-o-arrow-left class="w-5 h-5" />
                Kembali ke Tentang Kami
            </a>
        </div>
    </div>

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
                    @else
                    <div class="w-full h-56 bg-[#F1F5F9]"></div>
                    @endif
                </div>
                <div class="p-6">
                    <h3 class="text-lg font-bold text-[#1E293B] leading-snug line-clamp-2 mb-2 transition-colors duration-300 group-hover:text-brand-blue">
                        {{ $item->nama }}
                    </h3>
                    <p class="text-sm text-[#64748B] line-clamp-2">{{ $item->deskripsi }}</p>
                </div>
            </a>
            @endforeach
        </div>
    </div>
    @endif
</div>
@endsection
