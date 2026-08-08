<div class="bg-[#0F1E3D] rounded-3xl px-6 md:px-12 py-14 space-y-16">

    {{-- Judul Section --}}
    <h2 class="text-2xl font-bold text-white text-center">Jejak Langkah Kami</h2>

    {{-- Timeline --}}
    <div class="relative max-w-3xl mx-auto">
        {{-- Garis vertikal tengah --}}
        <div class="absolute left-1/2 top-0 bottom-0 w-px bg-white/20 -translate-x-1/2 hidden md:block"></div>

        <div class="space-y-10">
            @foreach($historyMilestones as $index => $item)
            <div class="relative flex flex-col md:flex-row items-center md:items-stretch gap-6
                        {{ $index % 2 === 1 ? 'md:flex-row-reverse' : '' }}">

                {{-- Kartu isi --}}
                <div class="w-full md:w-1/2 {{ $index % 2 === 1 ? 'md:pl-10' : 'md:pr-10' }}">
                    <div class="bg-white/5 border border-white/10 rounded-2xl p-6 text-left">
                        <h3 class="font-bold text-white mb-3">
                            {{ $item->judul }}
                        </h3>

                        <div class="text-sm text-white/70 leading-relaxed whitespace-pre-line text-left">
                            {{ $item->isi }}
                        </div>
                    </div>
                </div>

                {{-- Titik penanda di garis tengah --}}
                <div class="hidden md:flex w-4 h-4 rounded-full bg-emerald-400 border-4 border-[#0F1E3D] absolute left-1/2 top-6 -translate-x-1/2"></div>

                <div class="hidden md:block w-1/2"></div>
            </div>
            @endforeach
        </div>
    </div>

    {{-- Visi & Misi --}}
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 max-w-4xl mx-auto">
        <div class="bg-white rounded-2xl p-8">
            <h3 class="text-lg font-bold text-brand-blue mb-4">Visi Kami</h3>
            <p class="text-sm text-gray-600 leading-relaxed italic">
                "{{ $contents['visi'] ?? '-' }}"
            </p>
        </div>

        <div class="bg-white rounded-2xl p-8">
            <h3 class="text-lg font-bold text-brand-blue mb-4">Misi Kami</h3>
            <ul class="space-y-3">
                @foreach(explode("\n", $contents['misi'] ?? '') as $poin)
                @if(trim($poin) !== '')
                <li class="flex items-start gap-2 text-sm text-gray-600">
                    <x-heroicon-o-check-circle class="w-5 h-5 text-emerald-500 flex-shrink-0 mt-0.5" />
                    <span>{{ trim($poin) }}</span>
                </li>
                @endif
                @endforeach
            </ul>
        </div>
    </div>

    {{-- Filosofi Lambang --}}
    <div class="bg-white rounded-3xl p-8 md:p-12 max-w-5xl mx-auto">
        <h3 class="text-xl font-bold text-brand-blue text-center mb-6">Filosofi Lambang</h3>

        {{-- Logo di tengah atas --}}
        <div class="flex items-center justify-center mb-10">
            @if($contents['lambang'] ?? false)
            <img src="{{ $contents['lambang'] }}" alt="Logo" class="w-28 h-28 object-contain">
            @else
            <div class="w-28 h-28 rounded-full bg-gray-100"></div>
            @endif
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-10">

            {{-- Kolom kiri (5 poin) --}}
            <div class="space-y-6">
                @foreach($lambangMeanings['kiri'] ?? [] as $item)
                <div class="flex items-start gap-3">
                    <span class="w-2 h-2 rounded-full bg-brand-green mt-2 flex-shrink-0"></span>
                    <div>
                        <h4 class="font-semibold text-gray-700 text-sm mb-1">{{ $item->judul }}</h4>
                        <p class="text-xs text-gray-500 leading-relaxed">{{ $item->isi }}</p>
                    </div>
                </div>
                @endforeach
            </div>

            {{-- Kolom kanan (4 poin) --}}
            <div class="space-y-6">
                @foreach($lambangMeanings['kanan'] ?? [] as $item)
                <div class="flex items-start gap-3">
                    <span class="w-2 h-2 rounded-full bg-brand-blue mt-2 flex-shrink-0"></span>
                    <div>
                        <h4 class="font-semibold text-gray-700 text-sm mb-1">{{ $item->judul }}</h4>
                        <p class="text-xs text-gray-500 leading-relaxed">{{ $item->isi }}</p>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>

</div>