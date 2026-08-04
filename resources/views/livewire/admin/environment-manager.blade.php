<div class="space-y-6">
    @if (session('success'))
    <div class="bg-neu shadow-neu-in rounded-xl px-4 py-3 text-sm text-green-600">{{ session('success') }}</div>
    @endif

    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        <h1 class="text-xl font-bold text-gray-700">Kelola Info Lingkungan</h1>
        <button wire:click="create" class="bg-neu rounded-xl shadow-neu-out active:shadow-neu-in px-5 py-2 text-sm font-medium text-indigo-600 transition">
            + Tambah Info
        </button>
    </div>

    <div class="flex flex-col sm:flex-row gap-4">
        <input wire:model.live.debounce.300ms="search" type="text" placeholder="Cari judul..."
            class="bg-neu shadow-neu-in rounded-xl px-4 py-2 text-sm w-full sm:w-72 outline-none">
        <select wire:model.live="filterCategory" class="bg-neu shadow-neu-in rounded-xl px-4 py-2 text-sm outline-none">
            <option value="">Semua Kategori</option>
            <option value="informasi">Informasi</option>
            <option value="peraturan">Peraturan</option>
        </select>
    </div>

    <div class="bg-neu rounded-2xl shadow-neu-out p-4 overflow-x-auto">
        <table class="w-full text-sm">
            <thead>
                <tr class="text-left text-gray-500 border-b border-gray-200/60">
                    <th class="py-3 px-2">Judul</th>
                    <th class="py-3 px-2">Kategori</th>
                    <th class="py-3 px-2">Dibuat</th>
                    <th class="py-3 px-2 text-right">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($infos as $info)
                <tr class="border-b border-gray-100 last:border-0">
                    <td class="py-3 px-2 text-gray-700 font-medium">{{ $info->title }}</td>
                    <td class="py-3 px-2">
                        <span class="text-xs px-2 py-1 rounded-full bg-neu shadow-neu-in text-gray-600">
                            {{ $info->category === 'informasi' ? 'Informasi' : 'Peraturan' }}
                        </span>
                    </td>
                    <td class="py-3 px-2 text-gray-500">{{ $info->created_at->translatedFormat('d M Y') }}</td>
                    <td class="py-3 px-2 text-right space-x-2">
                        <button wire:click="edit({{ $info->id }})" class="text-indigo-500 hover:underline text-xs">Edit</button>
                        <button wire:click="confirmDelete({{ $info->id }})" class="text-red-500 hover:underline text-xs">Hapus</button>
                    </td>
                </tr>
                @empty
                <tr><td colspan="4" class="py-6 text-center text-gray-400">Belum ada data.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{ $infos->links() }}

    @if($showModal)
    <div class="fixed inset-0 bg-black/30 flex items-center justify-center z-50 p-4">
        <div class="bg-neu rounded-2xl shadow-neu-out p-6 w-full max-w-lg space-y-4">
            <h2 class="font-semibold text-gray-700">{{ $infoId ? 'Edit Info Lingkungan' : 'Tambah Info Lingkungan' }}</h2>

            <div>
                <label class="text-xs text-gray-500">Judul</label>
                <input wire:model="title" type="text" class="w-full bg-neu shadow-neu-in rounded-xl px-4 py-2 text-sm outline-none">
                @error('title') <span class="text-xs text-red-500">{{ $message }}</span> @enderror
            </div>

            <div>
                <label class="text-xs text-gray-500">Konten</label>
                <textarea wire:model="content" rows="5" class="w-full bg-neu shadow-neu-in rounded-xl px-4 py-2 text-sm outline-none"></textarea>
                @error('content') <span class="text-xs text-red-500">{{ $message }}</span> @enderror
            </div>

            <div>
                <label class="text-xs text-gray-500">Kategori</label>
                <select wire:model="category" class="w-full bg-neu shadow-neu-in rounded-xl px-4 py-2 text-sm outline-none">
                    <option value="informasi">Informasi</option>
                    <option value="peraturan">Peraturan</option>
                </select>
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
            <p class="text-gray-700">Yakin ingin menghapus info ini?</p>
            <div class="flex justify-center gap-3">
                <button wire:click="$set('showDeleteModal', false)" class="px-4 py-2 text-sm text-gray-500">Batal</button>
                <button wire:click="delete" class="bg-neu rounded-xl shadow-neu-out active:shadow-neu-in px-5 py-2 text-sm font-medium text-red-500">Hapus</button>
            </div>
        </div>
    </div>
    @endif
</div>