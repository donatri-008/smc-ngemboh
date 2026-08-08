@php
    $groups = ['tim1' => 'BPH', 'tim2' => 'Penanggung Jawab', 'tim3' => 'PPK Ormawa'];
@endphp

<div x-data="{ tab: 'tim1' }" class="max-w-5xl mx-auto space-y-8">
    <h2 class="text-xl font-bold text-gray-700 text-center">Pembagian Tim</h2>

    {{-- Tab Pills --}}
    <div class="flex justify-center">
        <div class="bg-neu shadow-neu-in rounded-full p-2 flex items-center gap-2">
            @foreach($groups as $key => $label)
            <button type="button" @click="tab = '{{ $key }}'"
                :class="tab === '{{ $key }}'
                    ? 'bg-neu shadow-neu-out text-brand-green'
                    : 'shadow-neu-in text-brand-green hover:bg-brand-green hover:text-white'"
                class="px-6 py-2 rounded-full text-sm font-semibold transition-all duration-300">
                {{ strtoupper($label) }}
            </button>
            @endforeach
        </div>
    </div>

    {{-- Konten per tab --}}
    @foreach($groups as $key => $label)
    <div x-show="tab === '{{ $key }}'" x-cloak>
        <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
            @forelse($teamByGroup[$key] ?? [] as $member)
            <div class="bg-white border border-[#F1F5F9] rounded-2xl p-6 text-center shadow-[0_4px_20px_-2px_rgba(0,0,0,0.05)]">
                @if($member->foto)
                <img src="{{ Storage::url($member->foto) }}" class="w-24 h-24 rounded-full object-cover mx-auto shadow">
                @else
                <div class="w-24 h-24 rounded-full bg-gray-100 mx-auto"></div>
                @endif
                <p class="text-sm font-bold text-gray-800 mt-4">{{ $member->nama }}</p>
                <p class="text-xs text-brand-blue mt-1">{{ $member->jabatan }}</p>
            </div>
            @empty
            <x-ui.empty-state message="Belum ada anggota." />
            @endforelse
        </div>
    </div>
    @endforeach
</div>
