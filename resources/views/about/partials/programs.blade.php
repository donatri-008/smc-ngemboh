<div>
    <h2 class="text-xl font-bold text-gray-700 mb-6">Program Kerja</h2>
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        @forelse($programs as $program)
        <x-ui.card class="space-y-3">
            <div class="w-12 h-12 rounded-xl bg-neu shadow-neu-in flex items-center justify-center">
                <x-dynamic-component :component="'heroicon-o-' . ($program->icon ?: 'sparkles')" class="w-6 h-6 text-indigo-500" />
            </div>
            <p class="font-semibold text-gray-700">{{ $program->nama }}</p>
            <p class="text-xs text-gray-500">{{ $program->deskripsi }}</p>
        </x-ui.card>
        @empty
        <x-ui.empty-state message="Belum ada program." />
        @endforelse
    </div>
</div>