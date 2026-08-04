<div class="space-y-6">
    @if (session('success'))
    <div class="bg-neu shadow-neu-in rounded-xl px-4 py-3 text-sm text-green-600">{{ session('success') }}</div>
    @endif

    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        <h1 class="text-xl font-bold text-gray-700">Kelola Artikel & Berita</h1>
        <button wire:click="create" class="bg-neu rounded-xl shadow-neu-out active:shadow-neu-in px-5 py-2 text-sm font-medium text-indigo-600 transition">
            + Tambah Artikel
        </button>
    </div>

    <div class="flex flex-col sm:flex-row gap-4">
        <input wire:model.live.debounce.300ms="search" type="text" placeholder="Cari judul artikel..."
            class="bg-neu shadow-neu-in rounded-xl px-4 py-2 text-sm w-full sm:w-72 outline-none">
        <select wire:model.live="filterCategory" class="bg-neu shadow-neu-in rounded-xl px-4 py-2 text-sm outline-none">
            <option value="">Semua Kategori</option>
            <option value="produk">Produk</option>
            <option value="berita_acara">Berita Acara</option>
        </select>
    </div>

    <div class="bg-neu rounded-2xl shadow-neu-out p-4 overflow-x-auto">
        <table class="w-full text-sm">
            <thead>
                <tr class="text-left text-gray-500 border-b border-gray-200/60">
                    <th class="py-3 px-2">Thumbnail</th>
                    <th class="py-3 px-2">Judul</th>
                    <th class="py-3 px-2">Kategori</th>
                    <th class="py-3 px-2">Tanggal Terbit</th>
                    <th class="py-3 px-2 text-right">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($articles as $article)
                <tr class="border-b border-gray-100 last:border-0">
                    <td class="py-3 px-2">
                        @if($article->thumbnail)
                        <img src="{{ Storage::url($article->thumbnail) }}" class="w-14 h-14 rounded-lg object-cover shadow-neu-in">
                        @else
                        <div class="w-14 h-14 rounded-lg bg-neu shadow-neu-in"></div>
                        @endif
                    </td>
                    <td class="py-3 px-2 text-gray-700 font-medium">{{ $article->title }}</td>
                    <td class="py-3 px-2">
                        <span class="text-xs px-2 py-1 rounded-full bg-neu shadow-neu-in text-gray-600">
                            {{ $article->category === 'produk' ? 'Produk' : 'Berita Acara' }}
                        </span>
                    </td>
                    <td class="py-3 px-2 text-gray-500">{{ $article->published_at?->translatedFormat('d M Y') ?? '-' }}</td>
                    <td class="py-3 px-2 text-right space-x-2">
                        <button wire:click="edit({{ $article->id }})" class="text-indigo-500 hover:underline text-xs">Edit</button>
                        <button wire:click="confirmDelete({{ $article->id }})" class="text-red-500 hover:underline text-xs">Hapus</button>
                    </td>
                </tr>
                @empty
                <tr><td colspan="5" class="py-6 text-center text-gray-400">Belum ada artikel.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{ $articles->links() }}

    @if($showModal)
    <div class="fixed inset-0 bg-black/30 flex items-center justify-center z-50 p-4">
        <div class="bg-neu rounded-2xl shadow-neu-out p-6 w-full max-w-lg space-y-4">
            <h2 class="font-semibold text-gray-700">{{ $articleId ? 'Edit Artikel' : 'Tambah Artikel' }}</h2>

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

            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="text-xs text-gray-500">Kategori</label>
                    <select wire:model="category" class="w-full bg-neu shadow-neu-in rounded-xl px-4 py-2 text-sm outline-none">
                        <option value="produk">Produk</option>
                        <option value="berita_acara">Berita Acara</option>
                    </select>
                </div>
                <div>
                    <label class="text-xs text-gray-500">Tanggal Terbit</label>
                    <input wire:model="published_at" type="date" class="w-full bg-neu shadow-neu-in rounded-xl px-4 py-2 text-sm outline-none">
                </div>
            </div>

            <div>
                <label class="text-xs text-gray-500">Thumbnail</label>
                <input wire:model="thumbnail" type="file" class="w-full text-sm">
                @error('thumbnail') <span class="text-xs text-red-500">{{ $message }}</span> @enderror

                @if($thumbnail)
                <img src="{{ $thumbnail->temporaryUrl() }}" class="w-20 h-20 rounded-lg object-cover mt-2 shadow-neu-in">
                @elseif($existingThumbnail)
                <img src="{{ Storage::url($existingThumbnail) }}" class="w-20 h-20 rounded-lg object-cover mt-2 shadow-neu-in">
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
            <p class="text-gray-700">Yakin ingin menghapus artikel ini?</p>
            <div class="flex justify-center gap-3">
                <button wire:click="$set('showDeleteModal', false)" class="px-4 py-2 text-sm text-gray-500">Batal</button>
                <button wire:click="delete" class="bg-neu rounded-xl shadow-neu-out active:shadow-neu-in px-5 py-2 text-sm font-medium text-red-500">Hapus</button>
            </div>
        </div>
    </div>
    @endif
</div>