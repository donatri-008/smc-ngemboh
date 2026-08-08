@extends('layouts.app')
@section('title', 'Info Lingkungan - Smart Maritim Community Ngemboh')

@section('content')
<div class="bg-blue-50/60">
    <div class="max-w-5xl mx-auto px-4 sm:px-6 pt-10 sm:pt-16 pb-8 sm:pb-10 text-center space-y-3 sm:space-y-4">
        <h1 class="text-3xl sm:text-4xl md:text-5xl font-extrabold text-blue-700">Info Lingkungan</h1>
        <p class="text-sm sm:text-base text-gray-500 max-w-xl mx-auto">Sajian informasi mengenai info lingkungan berdasarkan data Dinas Lingkungan Hidup kabupaten Gresik</p>
        @include('partials.data-tab-switcher', ['active' => 'lingkungan'])
    </div>

    <div class="max-w-4xl mx-auto px-4 sm:px-6 pb-16 space-y-5 sm:space-y-6">
        <h2 class="text-xl sm:text-2xl font-bold text-blue-700 flex items-center gap-2">
            <x-heroicon-o-document-text class="w-5 h-5 sm:w-6 sm:h-6" /> Deskripsi Lingkungan
        </h2>

        @if($infos->isEmpty())
        <x-ui.empty-state
            icon="globe-alt"
            title="Info Lingkungan Belum Tersedia"
            message="Data deskripsi lingkungan untuk Desa Ngemboh belum ditambahkan oleh admin. Silakan cek kembali beberapa saat lagi." />
        @else
        <div class="space-y-3 sm:space-y-4" x-data="{ open: null }">
            @foreach($infos as $i => $info)
            <div class="bg-white rounded-2xl shadow-sm overflow-hidden">
                <button @click="open = open === {{ $i }} ? null : {{ $i }}"
                        class="w-full flex justify-between items-center gap-3 px-4 sm:px-6 py-3.5 sm:py-4 bg-green-500/10 text-left">
                    <span class="font-medium text-blue-700 text-sm sm:text-base">{{ $info->title }}</span>
                    <x-heroicon-o-chevron-down class="w-4 h-4 shrink-0 text-blue-700 transition" ::class="open === {{ $i }} ? 'rotate-180' : ''" />
                </button>
                <div x-show="open === {{ $i }}" x-cloak class="px-4 sm:px-6 py-4 text-sm text-gray-600 leading-relaxed whitespace-pre-line">
                    {{ $info->content }}
                </div>
            </div>
            @endforeach
        </div>
        @endif
    </div>
</div>
@endsection