<div class="space-y-6">
    @if (session('success'))
    <div class="bg-neu shadow-neu-in rounded-xl px-4 py-3 text-sm text-green-600">{{ session('success') }}</div>
    @endif

    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        <h1 class="text-xl font-bold text-gray-700">Kelola Legalitas & Sertifikasi</h1>
        <button wire:click="create" class="bg-neu rounded-xl shadow-neu-out active:shadow-neu-in px-5 py-2 text-sm font-medium text-indigo-600 transition">
            + Tambah Dokumen
        </button>
    </div>

    <input wire:model.live.debounce.300ms="search" type="text" placeholder="Cari nama dokumen..."
        class="bg-neu shadow-neu-in rounded-xl px-4 py-2 text-sm w-full sm:w-72 outline-none">

    <div class="bg-neu rounded-2xl shadow-neu-out p-4 overflow-x-auto">
        <table class="w-full text-sm">
            <thead>
                <tr class="text-left text-gray-500 border-b border-gray-200/60">
                    <th class="py-3 px-2">Nama Dokumen</th>
                    <th class="py-3 px-2">Nomor</th>
                    <th class="py-3 px-2">Tanggal Terbit</th>
                    <th class="py-3 px-2">File</th>
                    <th class="py-3 px-2 text-right">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($legalities as $legality)
                <tr class="border-b border-gray-100 last:border-0">
                    <td class="py-3 px-2 text-gray-700 font-medium">{{ $legality->nama_dokumen }}</td>
                    <td class="py-3 px-2 text-gray-600">{{ $legality->nomor ?? '-' }}</td>
                    <td class="py-3 px-2 text-gray-500">{{ $legality->tanggal_terbit?->translatedFormat('d M Y') ?? '-' }}</td>
                    <td class="py-3 px-2">
                        <a href="{{ Storage::url($legality->file) }}" target="_blank" class="text-indigo-500 hover:underline text-xs">Lihat File</a>
                    </td>
                    <td class="py-3 px-2 text-right space-x-2">
                        <button wire:click="edit({{ $legality->id }})" class="text-indigo-500 hover:underline text-xs">Edit</button>
                        <button wire:click="confirmDelete({{ $legality->id }})" class="text-red-500 hover:underline text-xs">Hapus</button>
                    </td>
                </tr>
                @empty
                <tr><td colspan="5" class="py-6 text-center text-gray-400">Belum ada dokumen legalitas.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{ $legalities->links() }}

    @if($showModal)
    <div class="fixed inset-0 bg-black/30 flex items-center justify-center z-50 p-4">
        <div class="bg-neu rounded-2xl shadow-neu-out p-6 w-full max-w-md space-y-4">
            <h2 class="font-semibold text-gray-700">{{ $legalityId ? 'Edit Dokumen' : 'Tambah Dokumen' }}</h2>

            <div>
                <label class="text-xs text-gray-500">Nama Dokumen</label>
                <input wire:model="nama_dokumen" type="text" class="w-full bg-neu shadow-neu-in rounded-xl px-4 py-2 text-sm outline-none">
                @error('nama_dokumen') <span class="text-xs text-red-500">{{ $message }}</span> @enderror
            </div>

            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="text-xs text-gray-500">Nomor</label>
                    <input wire:model="nomor" type="text" class="w-full bg-neu shadow-neu-in rounded-xl px-4 py-2 text-sm outline-none">
                </div>
                <div>
                    <label class="text-xs text-gray-500">Tanggal Terbit</label>
                    <input wire:model="tanggal_terbit" type="date" class="w-full bg-neu shadow-neu-in rounded-xl px-4 py-2 text-sm outline-none">
                </div>
            </div>

            <div>
                <label class="text-xs text-gray-500">File (PDF/Gambar)</label>
                <input wire:model="file" type="file" accept=".pdf,.jpg,.jpeg,.png" class="w-full text-sm">
                @error('file') <span class="text-xs text-red-500">{{ $message }}</span> @enderror

                @if($existingFile && !$file)
                <a href="{{ Storage::url($existingFile) }}" target="_blank" class="text-xs text-indigo-500 hover:underline">Lihat file saat ini</a>
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
            <p class="text-gray-700">Yakin ingin menghapus dokumen ini?</p>
            <div class="flex justify-center gap-3">
                <button wire:click="$set('showDeleteModal', false)" class="px-4 py-2 text-sm text-gray-500">Batal</button>
                <button wire:click="delete" class="bg-neu rounded-xl shadow-neu-out active:shadow-neu-in px-5 py-2 text-sm font-medium text-red-500">Hapus</button>
            </div>
        </div>
    </div>
    @endif
</div>