<div class="space-y-6">
    @if (session('success'))
    <div class="bg-neu shadow-neu-in rounded-xl px-4 py-3 text-sm text-green-600">{{ session('success') }}</div>
    @endif

    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        <h1 class="text-xl font-bold text-gray-700">Kelola Program Kerja</h1>
        <button wire:click="create" class="bg-neu rounded-xl shadow-neu-out active:shadow-neu-in px-5 py-2 text-sm font-medium text-indigo-600 transition">
            + Tambah Program
        </button>
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
        @forelse($programs as $program)
        <div class="bg-neu rounded-2xl shadow-neu-out p-6 space-y-3">
            <div class="w-12 h-12 rounded-xl bg-neu shadow-neu-in flex items-center justify-center">
                @if($program->icon)
                <x-dynamic-component :component="'heroicon-o-' . $program->icon" class="w-6 h-6 text-indigo-500" />
                @else
                <x-heroicon-o-sparkles class="w-6 h-6 text-indigo-500" />
                @endif
            </div>
            <div>
                <p class="font-semibold text-gray-700">{{ $program->nama }}</p>
                <p class="text-xs text-gray-500 mt-1 line-clamp-3">{{ $program->deskripsi }}</p>
            </div>
            <div class="flex gap-3 pt-2">
                <button wire:click="edit({{ $program->id }})" class="text-indigo-500 hover:underline text-xs">Edit</button>
                <button wire:click="confirmDelete({{ $program->id }})" class="text-red-500 hover:underline text-xs">Hapus</button>
            </div>
        </div>
        @empty
        <p class="text-sm text-gray-400 col-span-full text-center py-6">Belum ada program kerja.</p>
        @endforelse
    </div>

    @if($showModal)
    <div class="fixed inset-0 bg-black/30 flex items-center justify-center z-50 p-4">
        <div class="bg-neu rounded-2xl shadow-neu-out p-6 w-full max-w-lg space-y-4">
            <h2 class="font-semibold text-gray-700">{{ $programId ? 'Edit Program' : 'Tambah Program' }}</h2>

            <div>
                <label class="text-xs text-gray-500">Nama Program</label>
                <input wire:model="nama" type="text" class="w-full bg-neu shadow-neu-in rounded-xl px-4 py-2 text-sm outline-none">
                @error('nama') <span class="text-xs text-red-500">{{ $message }}</span> @enderror
            </div>

            <div>
                <label class="text-xs text-gray-500">Deskripsi</label>
                <textarea wire:model="deskripsi" rows="4" class="w-full bg-neu shadow-neu-in rounded-xl px-4 py-2 text-sm outline-none"></textarea>
                @error('deskripsi') <span class="text-xs text-red-500">{{ $message }}</span> @enderror
            </div>

            <div>
                <label class="text-xs text-gray-500">Icon (nama heroicon, tanpa prefix)</label>
                <input wire:model="icon" type="text" placeholder="mis. academic-cap, heart, globe-alt"
                    class="w-full bg-neu shadow-neu-in rounded-xl px-4 py-2 text-sm outline-none">
                <p class="text-xs text-gray-400 mt-1">Cek daftar nama icon di heroicons.com (pakai style outline).</p>
                @error('icon') <span class="text-xs text-red-500">{{ $message }}</span> @enderror
            </div>

            <div class="flex justify-end gap-3 pt-2">
                <button wire:click="$set('showModal', false)" class="px-4 py-2 text-sm text-gray-500">Batal</button>
                <button wire:click="save" class="bg-neu rounded-xl shadow-neu-out active:shadow-neu-in px-5 py-2 text-sm font-medium text-indigo-600">Simpan</button>
            </div>
        </div>
    </div>
    @endif

    @if($showDeleteModal)
    <div class="fixed inset-0 bg-black/30 flex items-center justify-center z-50 p-4">
        <div class="bg-neu rounded-2xl shadow-neu-out p-6 w-full max-w-sm space-y-4 text-center">
            <p class="text-gray-700">Yakin ingin menghapus program ini?</p>
            <div class="flex justify-center gap-3">
                <button wire:click="$set('showDeleteModal', false)" class="px-4 py-2 text-sm text-gray-500">Batal</button>
                <button wire:click="delete" class="bg-neu rounded-xl shadow-neu-out active:shadow-neu-in px-5 py-2 text-sm font-medium text-red-500">Hapus</button>
            </div>
        </div>
    </div>
    @endif
</div>