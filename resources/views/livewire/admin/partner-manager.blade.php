<div class="space-y-6">
    @if (session('success'))
    <div class="bg-neu shadow-neu-in rounded-xl px-4 py-3 text-sm text-green-600">{{ session('success') }}</div>
    @endif

    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        <h1 class="text-xl font-bold text-gray-700">Kelola Mitra</h1>
        <button wire:click="create" class="bg-neu rounded-xl shadow-neu-out active:shadow-neu-in px-5 py-2 text-sm font-medium text-indigo-600 transition">
            + Tambah Mitra
        </button>
    </div>

    <input wire:model.live.debounce.300ms="search" type="text" placeholder="Cari nama mitra..."
        class="bg-neu shadow-neu-in rounded-xl px-4 py-2 text-sm w-full sm:w-72 outline-none">

    <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-5 gap-6">
        @forelse($partners as $partner)
        <div class="bg-neu rounded-2xl shadow-neu-out p-4 text-center space-y-3">
            <img src="{{ Storage::url($partner->logo) }}" class="w-16 h-16 object-contain mx-auto shadow-neu-in rounded-lg p-2">
            <p class="text-sm font-medium text-gray-700">{{ $partner->nama }}</p>
            <div class="flex justify-center gap-3">
                <button wire:click="edit({{ $partner->id }})" class="text-indigo-500 hover:underline text-xs">Edit</button>
                <button wire:click="confirmDelete({{ $partner->id }})" class="text-red-500 hover:underline text-xs">Hapus</button>
            </div>
        </div>
        @empty
        <p class="text-sm text-gray-400 col-span-full text-center py-6">Belum ada mitra.</p>
        @endforelse
    </div>

    {{ $partners->links() }}

    @if($showModal)
    <div class="fixed inset-0 bg-black/30 flex items-center justify-center z-50 p-4">
        <div class="bg-neu rounded-2xl shadow-neu-out p-6 w-full max-w-md space-y-4">
            <h2 class="font-semibold text-gray-700">{{ $partnerId ? 'Edit Mitra' : 'Tambah Mitra' }}</h2>

            <div>
                <label class="text-xs text-gray-500">Nama Mitra</label>
                <input wire:model="nama" type="text" class="w-full bg-neu shadow-neu-in rounded-xl px-4 py-2 text-sm outline-none">
                @error('nama') <span class="text-xs text-red-500">{{ $message }}</span> @enderror
            </div>

            <div>
                <label class="text-xs text-gray-500">Link (opsional)</label>
                <input wire:model="link" type="text" placeholder="https://..." class="w-full bg-neu shadow-neu-in rounded-xl px-4 py-2 text-sm outline-none">
                @error('link') <span class="text-xs text-red-500">{{ $message }}</span> @enderror
            </div>

            <div>
                <label class="text-xs text-gray-500">Logo</label>
                <input wire:model="logo" type="file" class="w-full text-sm">
                @error('logo') <span class="text-xs text-red-500">{{ $message }}</span> @enderror

                @if($logo)
                <img src="{{ $logo->temporaryUrl() }}" class="w-16 h-16 object-contain mt-2 shadow-neu-in rounded-lg p-2">
                @elseif($existingLogo)
                <img src="{{ Storage::url($existingLogo) }}" class="w-16 h-16 object-contain mt-2 shadow-neu-in rounded-lg p-2">
                @endif
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
            <p class="text-gray-700">Yakin ingin menghapus mitra ini?</p>
            <div class="flex justify-center gap-3">
                <button wire:click="$set('showDeleteModal', false)" class="px-4 py-2 text-sm text-gray-500">Batal</button>
                <button wire:click="delete" class="bg-neu rounded-xl shadow-neu-out active:shadow-neu-in px-5 py-2 text-sm font-medium text-red-500">Hapus</button>
            </div>
        </div>
    </div>
    @endif
</div>