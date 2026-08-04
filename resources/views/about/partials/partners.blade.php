<div>
    <h2 class="text-xl font-bold text-gray-700 mb-6">Mitra</h2>
    <div class="grid grid-cols-2 md:grid-cols-5 gap-6">
        @forelse($partners as $partner)
        <x-ui.card padding="p-4" class="text-center space-y-2">
            <img src="{{ Storage::url($partner->logo) }}" class="w-16 h-16 object-contain mx-auto shadow-neu-in rounded-lg p-2 bg-white">
            <p class="text-xs font-medium text-gray-700">{{ $partner->nama }}</p>
        </x-ui.card>
        @empty
        <x-ui.empty-state message="Belum ada mitra." />
        @endforelse
    </div>
</div>