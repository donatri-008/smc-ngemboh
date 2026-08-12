@php
    $scrollableMitra = $partners->count() > 2;
@endphp

<div id="mitra" class="max-w-5xl mx-auto scroll-mt-40">
    <h2 class="text-lg sm:text-xl font-bold text-brand-navy mb-4 sm:mb-6 text-center px-4">Mitra Strategis</h2>

    @if($partners->count() === 0)
    <x-ui.empty-state
        icon="building-office-2"
        title="Belum Ada Mitra"
        message="Daftar mitra kerja sama akan ditampilkan di sini setelah data ditambahkan." />
    @else

    <div class="relative">
        <div @class([
                'flex gap-3 sm:gap-6 overflow-x-auto pb-4 snap-x snap-mandatory hide-scrollbar -mx-4 sm:mx-0 px-4 sm:px-0 scroll-pl-4 sm:scroll-pl-0' => $scrollableMitra,
                'flex flex-wrap justify-center gap-4 sm:gap-8' => !$scrollableMitra,
                'sm:flex-wrap sm:justify-center sm:overflow-visible sm:pb-0 sm:snap-none' => $scrollableMitra,
            ])>
            @foreach($partners as $partner)
            <div @class([
                    'group bg-neu shadow-neu-flat rounded-3xl flex flex-col items-center gap-3 sm:gap-4 px-4 sm:px-6 py-5 sm:py-6 w-[140px] sm:w-[180px] transition-all duration-300 hover:-translate-y-1 cursor-default',
                    'flex-shrink-0 snap-start sm:flex-shrink' => $scrollableMitra,
                ])>
                <div class="bg-white shadow-neu-in rounded-full p-3 w-20 h-20 sm:w-28 sm:h-28 flex items-center justify-center overflow-hidden transition-transform duration-300 group-hover:scale-105">
                    <img src="{{ Storage::url($partner->logo) }}" class="max-w-full max-h-full object-contain">
                </div>
                <p class="text-xs sm:text-sm font-bold text-gray-700 text-center leading-snug transition-colors duration-300 group-hover:text-brand-green">{{ $partner->nama }}</p>
            </div>
            @endforeach

            @if($scrollableMitra)
            <div class="flex-shrink-0 w-px sm:hidden"></div>
            @endif
        </div>

        @if($scrollableMitra)
        <div class="sm:hidden pointer-events-none absolute top-0 right-0 bottom-4 w-10 bg-gradient-to-l from-blue-50/60 to-transparent"></div>
        @endif
    </div>
    @endif
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