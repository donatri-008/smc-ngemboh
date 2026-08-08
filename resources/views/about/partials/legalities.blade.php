@php
    $icons = ['document-text', 'check-badge', 'shield-check', 'cog-6-tooth'];
@endphp

<div x-data="{ open: false, title: '', kategori: '', image: '' }" class="max-w-5xl mx-auto">
    <h2 class="text-xl font-bold text-gray-700 mb-6 text-center">Sertifikasi & Legalitas</h2>

    <div class="flex gap-6 overflow-x-auto pb-4 snap-x snap-mandatory hide-scrollbar">
        @forelse($legalities as $index => $legality)
        <button type="button"
            @click="open = true;
                    title = @js($legality->nama_dokumen);
                    kategori = @js($legality->kategori);
                    image = @js($legality->file ? Storage::url($legality->file) : null)"
            class="flex-shrink-0 w-56 snap-start bg-white border border-[#F1F5F9] rounded-2xl p-6 flex flex-col items-center text-center gap-4
                   shadow-[0_4px_20px_-2px_rgba(0,0,0,0.05)] transition-all duration-300 hover:-translate-y-1">
            <div class="w-14 h-14 rounded-full bg-emerald-50 flex items-center justify-center">
                <x-dynamic-component :component="'heroicon-o-' . $icons[$index % count($icons)]" class="w-7 h-7 text-emerald-500" />
            </div>
            <p class="text-sm font-semibold text-gray-700">{{ $legality->nama_dokumen }}</p>
        </button>
        @empty
        <x-ui.empty-state message="Belum ada dokumen." />
        @endforelse
    </div>

    {{-- Modal --}}
    <div x-show="open" x-cloak @click="open = false"
         class="fixed inset-0 bg-black/50 flex items-center justify-center z-50 p-4">
        <div @click="open = false"
             class="bg-white rounded-3xl p-8 w-full max-w-2xl text-center">

            <h3 class="text-2xl font-bold text-brand-blue mb-1" x-text="title"></h3>
            <p class="text-sm text-gray-500 mb-6" x-show="kategori" x-text="kategori"></p>

            <img :src="image" class="w-full max-h-[420px] object-contain rounded-2xl mx-auto">
        </div>
    </div>
</div>
