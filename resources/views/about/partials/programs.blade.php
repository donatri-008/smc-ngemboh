<div id="program-kerja" class="max-w-5xl mx-auto scroll-mt-40">
    <h2 class="text-lg sm:text-xl font-bold text-gray-700 mb-4 sm:mb-6 text-center px-4">Program Kerja</h2>

    <div class="relative">
        <div class="flex gap-3 sm:gap-6 overflow-x-auto pb-4 snap-x snap-mandatory hide-scrollbar px-4 sm:px-0 scroll-pl-4 sm:scroll-pl-0">
            @forelse($programs as $program)
            <a href="{{ route('program.show', $program) }}?from=about"
               class="group relative flex-shrink-0 w-52 h-60 sm:w-64 sm:h-72 md:w-72 md:h-80 rounded-2xl overflow-hidden shadow-[0_4px_20px_-2px_rgba(0,0,0,0.1)] snap-start">

                @if($program->gambar)
                <img src="{{ asset($program->gambar) }}" alt="{{ $program->nama }}"
                    class="absolute inset-0 w-full h-full object-cover transition-transform duration-500 group-hover:scale-110">
                @else
                <div class="absolute inset-0 bg-gray-200"></div>
                @endif

                <div class="absolute inset-0 bg-gradient-to-t from-black/70 via-black/20 to-transparent"></div>

                <div class="absolute bottom-0 left-0 right-0 p-4 sm:p-5">
                    <p class="font-semibold text-white text-sm sm:text-lg mb-1">{{ $program->nama }}</p>
                    <p class="text-[11px] sm:text-xs text-white/80 line-clamp-2">{{ $program->deskripsi }}</p>
                </div>
            </a>
            @empty
            <x-ui.empty-state
                class="w-full"
                icon="clipboard-document-list"
                title="Belum Ada Program"
                message="Program kerja Smart Maritim Community akan tampil di sini setelah ditambahkan." />
            @endforelse

            <div class="flex-shrink-0 w-px sm:hidden"></div>
        </div>

        <div class="sm:hidden pointer-events-none absolute top-0 right-0 bottom-4 w-10 bg-gradient-to-l from-blue-50/60 to-transparent"></div>
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