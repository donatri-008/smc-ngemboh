<div class="space-y-6">
    @if (session('success'))
    <div class="bg-neu shadow-neu-in rounded-xl px-4 py-3 text-sm text-green-600">{{ session('success') }}</div>
    @endif

    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        <h1 class="text-xl font-bold text-gray-700">Kelola Produk</h1>
        <button wire:click="create" class="bg-neu rounded-xl shadow-neu-out active:shadow-neu-in px-5 py-2 text-sm font-medium text-indigo-600 transition">
            + Tambah Produk
        </button>
    </div>

    <div class="flex flex-col sm:flex-row gap-4">
        <input wire:model.live.debounce.300ms="search" type="text" placeholder="Cari nama produk..."
            class="bg-neu shadow-neu-in rounded-xl px-4 py-2 text-sm w-full sm:w-72 outline-none">
        <select wire:model.live="filterKategori" class="bg-neu shadow-neu-in rounded-xl px-4 py-2 text-sm outline-none">
            <option value="">Semua Kategori</option>
            <option value="lapak">Lapak</option>
            <option value="produk_luaran">Produk Luaran</option>
        </select>
    </div>

    <div class="bg-neu rounded-2xl shadow-neu-out p-4 overflow-x-auto">
        <table class="w-full text-sm">
            <thead>
                <tr class="text-left text-gray-500 border-b border-gray-200/60">
                    <th class="py-3 px-2">Gambar</th>
                    <th class="py-3 px-2">Nama</th>
                    <th class="py-3 px-2">Kategori</th>
                    <th class="py-3 px-2">Harga</th>
                    <th class="py-3 px-2">Stok</th>
                    <th class="py-3 px-2 text-right">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($products as $product)
                <tr class="border-b border-gray-100 last:border-0">
                    <td class="py-3 px-2">
                        @if($product->gambar)
                        <img src="{{ Storage::url($product->gambar) }}" class="w-14 h-14 rounded-lg object-cover shadow-neu-in">
                        @else
                        <div class="w-14 h-14 rounded-lg bg-neu shadow-neu-in"></div>
                        @endif
                    </td>
                    <td class="py-3 px-2 text-gray-700 font-medium">{{ $product->nama }}</td>
                    <td class="py-3 px-2">
                        <span class="text-xs px-2 py-1 rounded-full bg-neu shadow-neu-in text-gray-600">
                            {{ $product->kategori === 'lapak' ? 'Lapak' : 'Produk Luaran' }}
                        </span>
                    </td>
                    <td class="py-3 px-2 text-gray-600">Rp{{ number_format($product->harga, 0, ',', '.') }}</td>
                    <td class="py-3 px-2">
                        <span class="{{ $product->stok <= 5 ? 'text-red-500' : 'text-gray-600' }}">{{ $product->stok }}</span>
                    </td>
                    <td class="py-3 px-2 text-right space-x-2">
                        <button wire:click="edit({{ $product->id }})" class="text-indigo-500 hover:underline text-xs">Edit</button>
                        <button wire:click="confirmDelete({{ $product->id }})" class="text-red-500 hover:underline text-xs">Hapus</button>
                    </td>
                </tr>
                @empty
                <tr><td colspan="6" class="py-6 text-center text-gray-400">Belum ada produk.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{ $products->links() }}

    @if($showModal)
    <div class="fixed inset-0 bg-black/30 flex items-center justify-center z-50 p-4">
        <div class="bg-neu rounded-2xl shadow-neu-out p-6 w-full max-w-lg space-y-4">
            <h2 class="font-semibold text-gray-700">{{ $productId ? 'Edit Produk' : 'Tambah Produk' }}</h2>

            <div>
                <label class="text-xs text-gray-500">Nama Produk</label>
                <input wire:model="nama" type="text" class="w-full bg-neu shadow-neu-in rounded-xl px-4 py-2 text-sm outline-none">
                @error('nama') <span class="text-xs text-red-500">{{ $message }}</span> @enderror
            </div>

            <div>
                <label class="text-xs text-gray-500">Deskripsi</label>
                <textarea wire:model="deskripsi" rows="3" class="w-full bg-neu shadow-neu-in rounded-xl px-4 py-2 text-sm outline-none"></textarea>
            </div>

            <div class="grid grid-cols-3 gap-4">
                <div>
                    <label class="text-xs text-gray-500">Harga</label>
                    <input wire:model="harga" type="number" class="w-full bg-neu shadow-neu-in rounded-xl px-4 py-2 text-sm outline-none">
                    @error('harga') <span class="text-xs text-red-500">{{ $message }}</span> @enderror
                </div>
                <div>
                    <label class="text-xs text-gray-500">Stok</label>
                    <input wire:model="stok" type="number" class="w-full bg-neu shadow-neu-in rounded-xl px-4 py-2 text-sm outline-none">
                    @error('stok') <span class="text-xs text-red-500">{{ $message }}</span> @enderror
                </div>
                <div>
                    <label class="text-xs text-gray-500">Kategori</label>
                    <select wire:model="kategori" class="w-full bg-neu shadow-neu-in rounded-xl px-4 py-2 text-sm outline-none">
                        <option value="lapak">Lapak</option>
                        <option value="produk_luaran">Produk Luaran</option>
                    </select>
                </div>
            </div>

            <div>
                <label class="text-xs text-gray-500">Gambar</label>
                <input wire:model="gambar" type="file" class="w-full text-sm">
                @error('gambar') <span class="text-xs text-red-500">{{ $message }}</span> @enderror

                @if($gambar)
                <img src="{{ $gambar->temporaryUrl() }}" class="w-20 h-20 rounded-lg object-cover mt-2 shadow-neu-in">
                @elseif($existingGambar)
                <img src="{{ Storage::url($existingGambar) }}" class="w-20 h-20 rounded-lg object-cover mt-2 shadow-neu-in">
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
            <p class="text-gray-700">Yakin ingin menghapus produk ini?</p>
            <div class="flex justify-center gap-3">
                <button wire:click="$set('showDeleteModal', false)" class="px-4 py-2 text-sm text-gray-500">Batal</button>
                <button wire:click="delete" class="bg-neu rounded-xl shadow-neu-out active:shadow-neu-in px-5 py-2 text-sm font-medium text-red-500">Hapus</button>
            </div>
        </div>
    </div>
    @endif
</div>