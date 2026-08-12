@extends('layouts.app')
@section('title', 'Tentang Kami - Smart Maritim Community Ngemboh')

@section('content')
<div class="bg-section-blue pt-10 space-y-16">

    {{-- Judul Halaman --}}
    <div class="max-w-5xl mx-auto text-center px-4 sm:px-0 space-y-2 sm:space-y-3">
        <h1 class="text-3xl sm:text-4xl md:text-5xl font-bold text-brand-navy tracking-tight break-words">
            Tentang Kami
        </h1>
        <p class="text-sm sm:text-base text-ink max-w-2xl mx-auto leading-relaxed">
            Mengenal lebih dekat Smart Maritim Community Ngemboh — perjalanan, tim, legalitas, dan mitra kami.
        </p>
    </div>

    @include('about.partials.sambutan')
    @include('about.partials.sejarah')
    @include('about.partials.programs')
    @include('about.partials.legalities')
    @include('about.partials.partners')
    @include('about.partials.team')
    @include('about.partials.kontak')
</div>
@endsection