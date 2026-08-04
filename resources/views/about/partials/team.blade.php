<div class="space-y-8">
    <h2 class="text-xl font-bold text-gray-700">Profil Tim</h2>
    @foreach(['tim1' => 'Tim 1', 'tim2' => 'Tim 2', 'tim3' => 'Tim 3'] as $key => $label)
    <div>
        <h3 class="font-semibold text-gray-600 mb-4">{{ $label }}</h3>
        <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
            @forelse($teamByGroup[$key] ?? [] as $member)
            <x-ui.card padding="p-5" class="text-center space-y-2">
                @if($member->foto)
                <img src="{{ Storage::url($member->foto) }}" class="w-16 h-16 rounded-full object-cover mx-auto shadow-neu-in">
                @else
                <div class="w-16 h-16 rounded-full bg-neu shadow-neu-in mx-auto"></div>
                @endif
                <p class="text-sm font-medium text-gray-700">{{ $member->nama }}</p>
                <p class="text-xs text-gray-500">{{ $member->jabatan }}</p>
            </x-ui.card>
            @empty
            <x-ui.empty-state message="Belum ada anggota." />
            @endforelse
        </div>
    </div>
    @endforeach
</div>