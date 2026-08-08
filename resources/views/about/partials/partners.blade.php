<<<<<<< HEAD
<div id="mitra" class="max-w-5xl mx-auto scroll-mt-40">
    <h2 class="text-lg sm:text-xl font-bold text-gray-700 mb-4 sm:mb-6 text-center">Mitra</h2>
    <div class="grid grid-cols-2 md:grid-cols-4 gap-3 sm:gap-6">
=======
<div class="max-w-5xl mx-auto">
    <h2 class="text-xl font-bold text-gray-700 mb-6 text-center">Mitra</h2>
    <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
>>>>>>> 7c2b0c38c7cbb0458913dc97ac2a87842c5a8228
        @forelse($partners as $partner)
        <x-ui.card padding="p-3 sm:p-4" class="text-center space-y-2">
            <img src="{{ Storage::url($partner->logo) }}" class="w-12 h-12 sm:w-16 sm:h-16 object-contain mx-auto shadow-neu-in rounded-lg p-2 bg-white">
            <p class="text-[11px] sm:text-xs font-medium text-gray-700">{{ $partner->nama }}</p>
        </x-ui.card>
        @empty
        <x-ui.empty-state
            icon="building-office-2"
            title="Belum Ada Mitra"
            message="Daftar mitra kerja sama akan ditampilkan di sini setelah data ditambahkan." />
        @endforelse
    </div>
</div>
