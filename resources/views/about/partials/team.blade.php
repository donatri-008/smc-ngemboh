@php
    $groups = ['BPH' => 'BPH', 'Penanggung Jawab' => 'Penanggung Jawab', 'PPK Ormawa' => 'PPK Ormawa'];
@endphp

<div id="profil-tim" x-data="{ tab: 'BPH' }" class="bg-white rounded-2xl sm:rounded-3xl p-4 sm:p-6 md:p-8 lg:p-12 max-w-5xl mx-auto scroll-mt-40">
    <h2 class="text-base sm:text-lg md:text-2xl font-bold text-brand-navy text-center mb-4 sm:mb-6">Pembagian Tim</h2>

    {{-- Tab Pills --}}
    <div class="flex justify-center px-1">
        <div class="bg-neu shadow-neu-in rounded-full mb-5 sm:mb-6 p-1.5 sm:p-2 flex flex-wrap sm:flex-nowrap justify-center items-center gap-1.5 sm:gap-2 max-w-full sm:overflow-x-auto">
            @foreach($groups as $key => $label)
            <button type="button" @click="tab = '{{ $key }}'"
                :class="tab === '{{ $key }}'
                    ? 'bg-neu shadow-neu-out text-brand-green'
                    : 'shadow-neu-in text-brand-green hover:bg-brand-green hover:text-white'"
                class="px-3 sm:px-5 md:px-6 py-1.5 sm:py-2 rounded-full text-[11px] sm:text-sm font-semibold whitespace-nowrap transition-all duration-300">
                {{ strtoupper($label) }}
            </button>
            @endforeach
        </div>
    </div>

    {{-- Konten per tab --}}
    @foreach($groups as $key => $label)
    <div x-show="tab === '{{ $key }}'" x-cloak>
        <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 gap-3 sm:gap-4 md:gap-6">
            @forelse($teamByGroup[$key] ?? [] as $member)
            <div class="bg-neu shadow-neu-out rounded-2xl sm:rounded-3xl p-3 sm:p-5 md:p-6 text-center flex flex-col items-center gap-2 sm:gap-3 md:gap-4 transition-transform duration-300 hover:-translate-y-1">
                <div class="w-16 h-16 sm:w-20 sm:h-20 md:w-24 md:h-24 lg:w-28 lg:h-28 rounded-full bg-neu shadow-neu-in p-1 flex items-center justify-center shrink-0">
                    @if($member->foto)
                    <img src="{{ Storage::url($member->foto) }}" alt="{{ $member->nama }}" class="w-full h-full rounded-full object-cover">
                    @else
                    <div class="w-full h-full rounded-full bg-gray-100"></div>
                    @endif
                </div>
                <div>
                    <p class="text-[11px] sm:text-xs md:text-sm font-bold text-gray-800 leading-tight">{{ $member->nama }}</p>
                    <p class="text-[9px] sm:text-[10px] md:text-xs font-semibold tracking-wide text-brand-blue mt-0.5 sm:mt-1">{{ $member->jabatan }}</p>
                </div>
            </div>
            @empty
            <x-ui.empty-state
                icon="user-group"
                title="Belum Ada Anggota"
                message="Anggota tim untuk kelompok ini akan tampil di sini setelah data ditambahkan." />
            @endforelse
        </div>
    </div>
    @endforeach
</div>