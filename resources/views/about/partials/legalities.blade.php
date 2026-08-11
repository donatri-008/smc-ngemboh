@php
    $icons = ['document-text', 'check-badge', 'shield-check', 'cog-6-tooth'];
@endphp

<div id="legalitas" x-data="{ open: false, title: '', kategori: '', image: '' }" class="max-w-5xl mx-auto scroll-mt-40">
    <h2 class="text-lg sm:text-xl font-bold text-brand-navy mb-4 sm:mb-6 text-center">Sertifikasi & Legalitas</h2>

    <div class="flex gap-4 sm:gap-6 overflow-x-auto pb-4 snap-x snap-mandatory hide-scrollbar">
        @forelse($legalities as $index => $legality)
        <button type="button"
            @click="open = true;
                    title = @js($legality->nama_dokumen);
                    kategori = @js($legality->kategori);
                    image = @js($legality->file ? Storage::url($legality->file) : null)"
            class="flex-shrink-0 w-44 sm:w-56 snap-start bg-white border border-[#F1F5F9] rounded-2xl p-4 sm:p-6 flex flex-col items-center text-center gap-3 sm:gap-4
                   shadow-[0_4px_20px_-2px_rgba(0,0,0,0.05)] transition-all duration-300 hover:-translate-y-1">
            <div class="w-11 h-11 sm:w-14 sm:h-14 rounded-full bg-emerald-50 flex items-center justify-center">
                <x-dynamic-component :component="'heroicon-o-' . $icons[$index % count($icons)]" class="w-5 h-5 sm:w-7 sm:h-7 text-emerald-500" />
            </div>
            <p class="text-xs sm:text-sm font-semibold text-gray-700">{{ $legality->nama_dokumen }}</p>
        </button>
        @empty
        <x-ui.empty-state
            class="w-full"
            icon="document-text"
            title="Belum Ada Dokumen"
            message="Dokumen sertifikasi dan legalitas akan tampil di sini setelah ditambahkan oleh admin." />
        @endforelse
    </div>

    {{-- Modal --}}
    <div x-show="open" x-cloak @click="open = false"
         class="fixed inset-0 bg-black/50 flex items-center justify-center z-50 p-4">
        <div @click="open = false"
             class="bg-white rounded-2xl sm:rounded-3xl p-5 sm:p-8 w-full max-w-2xl text-center max-h-[90vh] overflow-y-auto">

            <h3 class="text-lg sm:text-2xl font-bold text-brand-blue mb-1" x-text="title"></h3>
            <p class="text-xs sm:text-sm text-gray-500 mb-4 sm:mb-6" x-show="kategori" x-text="kategori"></p>

            <img :src="image" class="w-full max-h-[300px] sm:max-h-[420px] object-contain rounded-2xl mx-auto">
        </div>
    </div>
</div>