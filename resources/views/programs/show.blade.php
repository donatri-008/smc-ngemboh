<<<<<<< HEAD
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
                    {{ $program->created_at->translatedFormat('d M Y') }}
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
                <a href="{{ $backUrl }}"
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
=======
<div class="space-y-6">
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        <h1 class="text-xl font-bold text-gray-700">Kelola Program Kerja</h1>
        <button wire:click="create" class="bg-neu rounded-xl shadow-neu-out active:shadow-neu-in px-5 py-2 text-sm font-medium text-indigo-600 transition">
            + Tambah Program
        </button>
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
        @forelse($programs as $program)
        <div class="bg-neu rounded-2xl shadow-neu-out p-6 space-y-3">
            <div class="w-12 h-12 rounded-xl bg-neu shadow-neu-in flex items-center justify-center">
                @if($program->icon)
                <x-dynamic-component :component="'heroicon-o-' . $program->icon" class="w-6 h-6 text-indigo-500" />
                @else
                <x-heroicon-o-sparkles class="w-6 h-6 text-indigo-500" />
                @endif
            </div>
            <div>
                <p class="font-semibold text-gray-700">{{ $program->nama }}</p>
                <p class="text-xs text-gray-500 mt-1 line-clamp-3">{{ $program->deskripsi }}</p>
            </div>
            <div class="flex gap-3 pt-2">
                <button wire:click="edit({{ $program->id }})" class="text-indigo-500 hover:underline text-xs">Edit</button>
                <button wire:click="confirmDelete({{ $program->id }})" class="text-red-500 hover:underline text-xs">Hapus</button>
            </div>
        </div>
        @empty
        <p class="text-sm text-gray-400 col-span-full text-center py-6">Belum ada program kerja.</p>
        @endforelse
    </div>

    @if($showModal)
    <div class="fixed inset-0 bg-black/30 flex items-center justify-center z-50 p-4">
        <div class="bg-neu rounded-2xl shadow-neu-out p-6 w-full max-w-lg space-y-4">
            <h2 class="font-semibold text-gray-700">{{ $programId ? 'Edit Program' : 'Tambah Program' }}</h2>

            <div>
                <label class="text-xs text-gray-500">Nama Program</label>
                <input wire:model="nama" type="text" class="w-full bg-neu shadow-neu-in rounded-xl px-4 py-2 text-sm outline-none">
                @error('nama') <span class="text-xs text-red-500">{{ $message }}</span> @enderror
            </div>

            <div>
                <label class="text-xs text-gray-500">Deskripsi</label>
                <textarea wire:model="deskripsi" rows="4" class="w-full bg-neu shadow-neu-in rounded-xl px-4 py-2 text-sm outline-none"></textarea>
                @error('deskripsi') <span class="text-xs text-red-500">{{ $message }}</span> @enderror
            </div>

            <div>
                <label class="text-xs text-gray-500">Icon (nama heroicon, tanpa prefix)</label>
                <input wire:model="icon" type="text" placeholder="mis. academic-cap, heart, globe-alt"
                    class="w-full bg-neu shadow-neu-in rounded-xl px-4 py-2 text-sm outline-none">
                <p class="text-xs text-gray-400 mt-1">Cek daftar nama icon di heroicons.com (pakai style outline).</p>
                @error('icon') <span class="text-xs text-red-500">{{ $message }}</span> @enderror
            </div>

            <div class="flex justify-end gap-3 pt-2">
                <button wire:click="$set('showModal', false)" class="px-4 py-2 text-sm text-gray-500">Batal</button>
                <button wire:click="save" class="bg-neu rounded-xl shadow-neu-out active:shadow-neu-in px-5 py-2 text-sm font-medium text-indigo-600">Simpan</button>
            </div>
        </div>
    </div>
    @endif

    @if($showDeleteModal)
    <div class="fixed inset-0 bg-black/30 flex items-center justify-center z-50 p-4">
        <div class="bg-neu rounded-2xl shadow-neu-out p-6 w-full max-w-sm space-y-4 text-center">
            <p class="text-gray-700">Yakin ingin menghapus program ini?</p>
            <div class="flex justify-center gap-3">
                <button wire:click="$set('showDeleteModal', false)" class="px-4 py-2 text-sm text-gray-500">Batal</button>
                <button wire:click="delete" class="bg-neu rounded-xl shadow-neu-out active:shadow-neu-in px-5 py-2 text-sm font-medium text-red-500">Hapus</button>
            </div>
        </div>
    </div>
    @endif
</div>
>>>>>>> 7c2b0c38c7cbb0458913dc97ac2a87842c5a8228
