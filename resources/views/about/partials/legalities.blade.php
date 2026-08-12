@php
    $icons = ['document-text', 'check-badge', 'shield-check', 'cog-6-tooth'];
    $scrollableLegalitas = $legalities->count() > 2;
@endphp

<div id="legalitas" x-data="{ open: false, title: '', kategori: '', image: '' }" class="bg-white rounded-2xl sm:rounded-3xl p-5 sm:p-8 md:p-12 max-w-5xl mx-auto scroll-mt-40">
    <h2 class="text-lg sm:text-xl md:text-2xl font-bold text-brand-navy text-center mb-4 sm:mb-6">Sertifikasi & Legalitas</h2>

    @if($legalities->count() === 0)
    <x-ui.empty-state
        icon="document-text"
        title="Belum Ada Dokumen"
        message="Dokumen sertifikasi dan legalitas akan tampil di sini setelah ditambahkan oleh admin." />
    @else

    <div class="relative">
        <div @class([
                'flex gap-3 sm:gap-6 overflow-x-auto pb-4 snap-x snap-mandatory hide-scrollbar -mx-5 sm:mx-0 px-5 sm:px-0 scroll-pl-5 sm:scroll-pl-0' => $scrollableLegalitas,
                'grid grid-cols-2 sm:grid-cols-4 gap-4 sm:gap-6' => !$scrollableLegalitas,
                'sm:grid sm:grid-cols-4 sm:overflow-visible sm:pb-0 sm:snap-none' => $scrollableLegalitas,
            ])>
            @foreach($legalities as $index => $legality)
            <button type="button"
                @click="open = true;
                        title = @js($legality->nama_dokumen);
                        kategori = @js($legality->kategori);
                        image = @js($legality->file ? Storage::url($legality->file) : null)"
                @class([
                    'bg-neu shadow-neu-in rounded-2xl sm:rounded-3xl flex flex-col items-center justify-center text-center gap-4 sm:gap-5 px-4 py-10 sm:py-14 min-h-[220px] sm:min-h-[290px] transition-transform duration-300 hover:-translate-y-1',
                    'flex-shrink-0 w-40 snap-start sm:w-auto' => $scrollableLegalitas,
                ])>
                <x-dynamic-component :component="'heroicon-o-' . $icons[$index % count($icons)]" class="w-8 h-8 sm:w-10 sm:h-10 text-brand-green shrink-0" />
                <p class="text-xs sm:text-sm font-bold text-gray-700 leading-snug tracking-wide">{{ $legality->nama_dokumen }}</p>
            </button>
            @endforeach

            @if($scrollableLegalitas)
            <div class="flex-shrink-0 w-px sm:hidden"></div>
            @endif
        </div>

        @if($scrollableLegalitas)
        <div class="sm:hidden pointer-events-none absolute top-0 right-0 bottom-4 w-10 bg-gradient-to-l from-white to-transparent"></div>
        @endif
    </div>
    @endif

    {{-- Modal --}}
    <div x-show="open" x-cloak @click="open = false"
         class="fixed inset-0 bg-black/50 flex items-center justify-center z-50 p-4">
        <div @click.stop
             class="bg-white rounded-2xl sm:rounded-3xl p-5 sm:p-8 w-full max-w-2xl text-center max-h-[90vh] overflow-y-auto">

            <h3 class="text-lg sm:text-2xl font-bold text-brand-blue mb-1" x-text="title"></h3>
            <p class="text-xs sm:text-sm text-gray-500 mb-4 sm:mb-6" x-show="kategori" x-text="kategori"></p>

            <img :src="image" class="w-full max-h-[300px] sm:max-h-[420px] object-contain rounded-2xl mx-auto">

            <button type="button" @click="open = false"
                    class="mt-6 text-xs sm:text-sm text-gray-400 hover:text-gray-600">
                Tutup
            </button>
        </div>
    </div>
</div>

<style>
    .hide-scrollbar {
        scrollbar-width: none;
        -ms-overflow-style: none;
    }
    .hide-scrollbar::-webkit-scrollbar {
        display: none;
    }
</style>