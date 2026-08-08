@php
    $groups = ['tim1' => 'BPH', 'tim2' => 'Penanggung Jawab', 'tim3' => 'PPK Ormawa'];
@endphp

<div id="profil-tim" x-data="{ tab: 'tim1' }" class="max-w-5xl mx-auto space-y-5 sm:space-y-8 scroll-mt-40">
    <h2 class="text-lg sm:text-xl font-bold text-gray-700 text-center">Pembagian Tim</h2>

    {{-- Tab Pills --}}
    <div class="flex justify-center">
        <div class="bg-neu shadow-neu-in rounded-full p-1.5 sm:p-2 flex items-center gap-1.5 sm:gap-2 max-w-full overflow-x-auto">
            @foreach($groups as $key => $label)
            <button type="button" @click="tab = '{{ $key }}'"
                :class="tab === '{{ $key }}'
                    ? 'bg-neu shadow-neu-out text-brand-green'
                    : 'shadow-neu-in text-brand-green hover:bg-brand-green hover:text-white'"
                class="px-3.5 sm:px-6 py-1.5 sm:py-2 rounded-full text-xs sm:text-sm font-semibold whitespace-nowrap transition-all duration-300">
                {{ strtoupper($label) }}
            </button>
            @endforeach
        </div>
    </div>

    {{-- Konten per tab --}}
    @foreach($groups as $key => $label)
    <div x-show="tab === '{{ $key }}'" x-cloak>
        <div class="grid grid-cols-2 md:grid-cols-4 gap-3 sm:gap-6">
            @forelse($teamByGroup[$key] ?? [] as $member)
            <div class="bg-white border border-[#F1F5F9] rounded-2xl p-4 sm:p-6 text-center shadow-[0_4px_20px_-2px_rgba(0,0,0,0.05)]">
                @if($member->foto)
                <img src="{{ Storage::url($member->foto) }}" class="w-16 h-16 sm:w-24 sm:h-24 rounded-full object-cover mx-auto shadow">
                @else
                <div class="w-16 h-16 sm:w-24 sm:h-24 rounded-full bg-gray-100 mx-auto"></div>
                @endif
                <p class="text-xs sm:text-sm font-bold text-gray-800 mt-3 sm:mt-4">{{ $member->nama }}</p>
                <p class="text-[11px] sm:text-xs text-brand-blue mt-1">{{ $member->jabatan }}</p>
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