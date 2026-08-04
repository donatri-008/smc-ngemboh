<div>
    <h2 class="text-xl font-bold text-gray-700 mb-6">Legalitas & Sertifikasi</h2>
    <x-ui.card padding="p-4" class="divide-y divide-gray-200/60">
        @forelse($legalities as $legality)
        <div class="flex items-center justify-between py-3">
            <div>
                <p class="text-sm font-medium text-gray-700">{{ $legality->nama_dokumen }}</p>
                <p class="text-xs text-gray-500">{{ $legality->nomor }} &middot; {{ $legality->tanggal_terbit?->translatedFormat('d M Y') }}</p>
            </div>
            <a href="{{ Storage::url($legality->file) }}" target="_blank" class="text-xs text-indigo-500 hover:underline">Lihat Dokumen</a>
        </div>
        @empty
        <x-ui.empty-state message="Belum ada dokumen." />
        @endforelse
    </x-ui.card>
</div>