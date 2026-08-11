<div class="bg-neu rounded-3xl px-4 sm:px-6 md:px-12 py-8 sm:py-14 space-y-10 sm:space-y-16">

    {{-- Jejak Langkah Kami --}}
    <div id="jejak-langkah" class="scroll-mt-40">
        <h2 class="text-xl sm:text-2xl font-bold text-brand-navy text-center mb-8 sm:mb-16">Jejak Langkah Kami</h2>

        {{-- ===== Versi Mobile/Tablet: garis vertikal di kiri ===== --}}
        <div class="md:hidden max-w-3xl mx-auto">
            @foreach($historyMilestones as $item)
            <div class="flex gap-4">
                {{-- Kolom dot + garis penyambung --}}
                <div class="flex flex-col items-center">
                    <span class="w-3 h-3 rounded-full bg-brand-green shrink-0 mt-1.5"></span>
                    @if(!$loop->last)
                    <span class="w-3 flex-1 bg-white rounded-full shadow-[0_0_0_1px_rgba(0,0,0,0.08)]"></span>
                    @endif
                </div>

                {{-- Kartu isi --}}
                <div class="flex-1 pb-6 sm:pb-10 min-w-0">
                    <div class="bg-white border border-gray-100 rounded-2xl p-4 sm:p-6 text-left shadow-sm">
                        <h3 class="font-bold text-gray-800 text-sm sm:text-base mb-2 sm:mb-3">
                            {{ $item->judul }}
                        </h3>
                        <div class="text-xs sm:text-sm text-gray-500 leading-relaxed whitespace-pre-line text-left">
                            {{ $item->isi }}
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        {{-- ===== Versi Desktop: zigzag kiri-kanan seperti semula ===== --}}
        <div class="hidden md:block relative max-w-3xl mx-auto">
            <div class="absolute left-1/2 top-0 bottom-0 w-3 bg-white rounded-full shadow-[0_0_0_1px_rgba(0,0,0,0.08)] -translate-x-1/2"></div>

            <div class="space-y-10">
                @foreach($historyMilestones as $index => $item)
                <div class="relative flex items-stretch gap-6
                            {{ $index % 2 === 1 ? 'flex-row-reverse' : '' }}">

                    <div class="w-1/2 {{ $index % 2 === 1 ? 'pl-10' : 'pr-10' }}">
                        <div class="bg-white border border-gray-100 rounded-2xl p-6 text-left shadow-sm">
                            <h3 class="font-bold text-brand-navy text-base mb-3">
                                {{ $item->judul }}
                            </h3>
                            <div class="text-sm text-gray-500 leading-relaxed whitespace-pre-line text-left">
                                {{ $item->isi }}
                            </div>
                        </div>
                    </div>

                    <div class="flex w-4 h-4 rounded-full bg-brand-green border-4 border-neu absolute left-1/2 top-6 -translate-x-1/2"></div>

                    <div class="w-1/2"></div>
                </div>
                @endforeach
            </div>
        </div>
    </div>

    {{-- Visi & Misi --}}
    <div id="visi-misi" class="grid grid-cols-1 md:grid-cols-2 gap-4 sm:gap-6 max-w-4xl mx-auto scroll-mt-40">
        <div class="bg-white rounded-2xl p-5 sm:p-8">
            <h3 class="text-base sm:text-lg font-bold text-brand-navy mb-3 sm:mb-4">Visi Kami</h3>
            <p class="text-xs sm:text-sm text-gray-600 leading-relaxed italic">
                "{{ $contents['visi'] ?? '-' }}"
            </p>
        </div>

        <div class="bg-white rounded-2xl p-5 sm:p-8">
            <h3 class="text-base sm:text-lg font-bold text-brand-navy mb-3 sm:mb-4">Misi Kami</h3>
            <ul class="space-y-2.5 sm:space-y-3">
                @foreach(explode("\n", $contents['misi'] ?? '') as $poin)
                @if(trim($poin) !== '')
                <li class="flex items-start gap-2 text-xs sm:text-sm text-gray-600">
                    <x-heroicon-o-check-circle class="w-4 h-4 sm:w-5 sm:h-5 text-emerald-500 flex-shrink-0 mt-0.5" />
                    <span>{{ trim($poin) }}</span>
                </li>
                @endif
                @endforeach
            </ul>
        </div>
    </div>

    {{-- Filosofi Lambang --}}
    <div id="filosofi-lambang" class="bg-white rounded-2xl sm:rounded-3xl p-5 sm:p-8 md:p-12 max-w-5xl mx-auto scroll-mt-40">
        <h3 class="text-lg sm:text-xl md:text-2xl font-bold text-brand-navy text-center mb-5 sm:mb-6">Filosofi Lambang</h3>

        <div class="flex items-center justify-center mb-6 sm:mb-10">
            @if($images['lambang'] ?? false)
            <div class="w-36 h-36 sm:w-48 sm:h-48 md:w-64 md:h-64 rounded-full bg-white shadow-[0_10px_30px_-5px_rgba(0,0,0,0.15)] flex items-center justify-center p-3 sm:p-4">
                <img src="{{ asset($images['lambang']) }}" alt="Logo Lambang" class="w-full h-full object-contain">
            </div>
            @else
            <div class="w-36 h-36 sm:w-48 sm:h-48 md:w-64 md:h-64 rounded-full bg-gray-100 shadow-[0_10px_30px_-5px_rgba(0,0,0,0.15)]"></div>
            @endif
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 sm:gap-5 md:gap-6">
            <div class="space-y-3 sm:space-y-5">
                @foreach($lambangMeanings['kiri'] ?? [] as $item)
                <div class="flex items-start gap-3 sm:gap-4 bg-gray-50 rounded-2xl p-4 sm:p-5 shadow-[-6px_-6px_12px_#FFFFFF,6px_6px_12px_#BABECC]">
                    @if($item->icon)
                    <img src="{{ asset($item->icon) }}" alt="{{ $item->judul }}" class="w-7 h-7 sm:w-9 sm:h-9 object-contain flex-shrink-0">
                    @else
                    <span class="w-2 h-2 rounded-full bg-brand-green mt-2 flex-shrink-0"></span>
                    @endif
                    <div class="min-w-0">
                        <h4 class="font-semibold text-gray-700 text-xs sm:text-sm mb-1">{{ $item->judul }}</h4>
                        <p class="text-[11px] sm:text-xs text-gray-500 leading-relaxed">{{ $item->isi }}</p>
                    </div>
                </div>
                @endforeach
            </div>

            <div class="space-y-3 sm:space-y-5">
                @foreach($lambangMeanings['kanan'] ?? [] as $item)
                <div class="flex items-start gap-3 sm:gap-4 bg-gray-50 rounded-2xl p-4 sm:p-5 shadow-[-6px_-6px_12px_#FFFFFF,6px_6px_12px_#BABECC]">
                    @if($item->icon)
                    <img src="{{ asset($item->icon) }}" alt="{{ $item->judul }}" class="w-7 h-7 sm:w-9 sm:h-9 object-contain flex-shrink-0">
                    @else
                    <span class="w-2 h-2 rounded-full bg-brand-green mt-2 flex-shrink-0"></span>
                    @endif
                    <div class="min-w-0">
                        <h4 class="font-semibold text-gray-700 text-xs sm:text-sm mb-1">{{ $item->judul }}</h4>
                        <p class="text-[11px] sm:text-xs text-gray-500 leading-relaxed">{{ $item->isi }}</p>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>

</div>