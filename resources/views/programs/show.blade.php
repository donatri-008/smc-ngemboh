@extends('layouts.app')

@section('title', $program->nama . ' - Smart Maritim Community Ngemboh')

@section('content')
@php
    $from = request('from');
    $backUrl = match($from) {
        'about' => route('about.index') . '#program-kerja',
        default => route('home') . '#program-smc',
    };
    $backLabel = match($from) {
        'about' => 'Kembali ke Tentang Kami',
        default => 'Kembali ke Beranda',
    };
@endphp

<div class="min-h-screen bg-gradient-to-b from-[#F8FAFC] to-[#F8FAFC]">

    <div class="max-w-[1280px] mx-auto flex flex-col items-center px-4 sm:px-6 lg:px-8 py-6 sm:py-10 gap-8 sm:gap-12">

        <div class="w-full max-w-[800px] flex flex-col gap-4 sm:gap-6 min-w-0">

            {{-- Title --}}
            <div class="flex flex-row justify-between items-start w-full">
                <h1 class="text-xl sm:text-2xl lg:text-3xl font-bold leading-snug text-[#2655B6] break-words">
                    {{ $program->nama }}
                </h1>
            </div>

            {{-- Meta Info --}}
            <div class="flex items-center gap-2 w-full pb-4 sm:pb-6 border-b border-[#F1F5F9]">
                <x-heroicon-o-calendar class="w-4 h-4 sm:w-[18px] sm:h-[18px] text-[#2655B6] shrink-0" />
                <span class="text-xs sm:text-sm text-[#64748B]">
                    {{ $program->created_at->translatedFormat('d F Y') }}
                </span>
            </div>

            {{-- Gambar Utama --}}
            @if($program->gambar)
            <div class="w-full h-[200px] sm:h-[280px] md:h-[340px] lg:h-[400px] rounded-xl sm:rounded-2xl overflow-hidden shadow-[0px_4px_6px_-1px_rgba(0,0,0,0.1),0px_2px_4px_-2px_rgba(0,0,0,0.1)]">
                <img src="{{ asset($program->gambar) }}" alt="{{ $program->nama }}" class="w-full h-full object-cover">
            </div>
            @else
            <div class="w-full h-[180px] sm:h-[240px] md:h-[300px] lg:h-[340px] rounded-xl sm:rounded-2xl bg-gray-100 shadow-[0px_4px_6px_-1px_rgba(0,0,0,0.1),0px_2px_4px_-2px_rgba(0,0,0,0.1)] flex items-center justify-center">
                <x-heroicon-o-photo class="w-10 h-10 sm:w-12 sm:h-12 text-gray-300" />
            </div>
            @endif

            {{-- Body Paragraphs --}}
            <div class="w-full py-1 pb-5 sm:pb-8 flex flex-col gap-3 sm:gap-4">
                @foreach(explode("\n\n", $program->konten) as $paragraph)
                    @if(trim($paragraph) !== '')
                    <p class="text-sm sm:text-base leading-relaxed text-[#475569] break-words">
                        {{ trim($paragraph) }}
                    </p>
                    @endif
                @endforeach
            </div>

            {{-- Back Button --}}
            <div class="w-full pt-5 sm:pt-8 border-t border-[#F1F5F9]">
                <a href="{{ $backUrl }}" aria-label="{{ $backLabel }}"
                   class="group inline-flex items-center gap-2 px-4 sm:px-6 py-2.5 rounded-full border border-[#E2E8F0] shadow-[0px_1px_2px_rgba(0,0,0,0.05)]
                          transition-all duration-300 ease-out
                          hover:bg-[#4CC71C] hover:border-[#4CC71C] hover:shadow-[0px_4px_12px_-2px_rgba(76,199,28,0.4)] hover:-translate-x-1
                          active:scale-95">
                    <x-heroicon-o-arrow-left class="w-4 h-4 text-[#4CC71C] transition-all duration-300 group-hover:text-white group-hover:-translate-x-1" />
                    <span class="text-xs sm:text-sm font-semibold text-[#4CC71C] transition-colors duration-300 group-hover:text-white">
                        {{ $backLabel }}
                    </span>
                </a>
            </div>

        </div>

    </div>

</div>
@endsection