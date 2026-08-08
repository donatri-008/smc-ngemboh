<div class="space-y-6">
    @if (session('success'))
    <div class="bg-neu shadow-neu-in rounded-xl px-4 py-3 text-sm text-green-600">{{ session('success') }}</div>
    @endif

    {{-- Header --}}
    <div>
        <h1 class="text-2xl font-bold text-brand-blue">Artikel & Berita</h1>
        <p class="text-sm text-gray-500 mt-1">Tulis dan publikasikan artikel maupun berita acara yang tampil di halaman publik</p>
    </div>

    {{-- Stat Cards --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
        <div class="bg-neu shadow-neu-out rounded-2xl p-5 flex flex-col gap-4">
            <div class="w-10 h-10 rounded-xl bg-blue-100 flex items-center justify-center">
                <x-heroicon-o-document-text class="w-5 h-5 text-blue-500" />
            </div>
            <div>
                <p class="text-sm text-gray-400">Total Artikel</p>
                <p class="text-2xl font-bold text-gray-700">{{ $totalArticles ?? $articles->total() }}</p>
            </div>
        </div>

        <div class="bg-neu shadow-neu-out rounded-2xl p-5 flex flex-col gap-4">
            <div class="w-10 h-10 rounded-xl bg-red-100 flex items-center justify-center">
                <x-heroicon-o-clipboard-document-list class="w-5 h-5 text-red-500" />
            </div>
            <div>
                <p class="text-sm text-gray-400">Total Artikel Gagal</p>
                <p class="text-2xl font-bold text-gray-700">{{ $totalFailedArticles ?? 0 }}</p>
            </div>
        </div>
    </div>

    {{-- Main Card --}}
    <div class="bg-neu rounded-2xl shadow-neu-out p-6 space-y-6">

        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <h2 class="text-lg font-bold text-brand-blue">Daftar Artikel & Berita</h2>
            <button wire:click="create"
                class="bg-brand-green rounded-full shadow-neu-out active:shadow-neu-in px-5 py-2.5 text-sm font-medium text-white flex items-center gap-2 transition hover:opacity-90">
                <x-heroicon-o-plus class="w-4 h-4" />
                Tambah Artikel
            </button>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead>
                    <tr class="text-left text-gray-400 border-b border-gray-100">
                        <th class="py-3 px-2 font-medium">Judul Artikel</th>
                        <th class="py-3 px-2 font-medium">Kategori</th>
                        <th class="py-3 px-2 font-medium">Tanggal Terbit</th>
                        <th class="py-3 px-2 font-medium">Status</th>
                        <th class="py-3 px-2 font-medium text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($articles as $article)
                    <tr class="border-b border-gray-100 last:border-0">
                        <td class="py-4 px-2">
                            <div class="flex items-center gap-3">
                                @if($article->thumbnail)
                                <img src="{{ Storage::url($article->thumbnail) }}" class="w-12 h-12 rounded-lg object-cover shadow-neu-in">
                                @else
                                <div class="w-12 h-12 rounded-lg bg-neu shadow-neu-in"></div>
                                @endif
                                <div>
                                    <p class="font-semibold text-gray-700 leading-snug">{{ $article->title }}</p>
                                    @isset($article->author)
                                    <p class="text-xs text-gray-400 mt-0.5">Oleh: {{ $article->author }}</p>
                                    @endisset
                                </div>
                            </div>
                        </td>
                        <td class="py-4 px-2">
                            <span class="text-xs px-3 py-1 rounded-full font-semibold
                                {{ $article->category === 'produk' ? 'bg-green-100 text-green-600' : 'bg-blue-100 text-blue-600' }}">
                                {{ $article->category === 'produk' ? 'Artikel Berita' : 'Berita Acara' }}
                            </span>
                        </td>
                        <td class="py-4 px-2 text-gray-500">
                            {{ $article->published_at?->translatedFormat('d M Y') ?? '-' }}
                        </td>
                        <td class="py-4 px-2">
                            @isset($article->status)
                            <span class="inline-flex items-center gap-1.5 text-xs font-medium
                                {{ $article->status === 'sukses' ? 'text-green-600' : 'text-red-500' }}">
                                <span class="w-1.5 h-1.5 rounded-full
                                    {{ $article->status === 'sukses' ? 'bg-green-500' : 'bg-red-500' }}"></span>
                                {{ $article->status === 'sukses' ? 'Sukses' : 'Gagal' }}
                            </span>
                            @else
                            <span class="text-xs text-gray-300">-</span>
                            @endisset
                        </td>
                        <td class="py-4 px-2">
                            <div class="flex items-center justify-end gap-2">
                                <button wire:click="edit({{ $article->id }})"
                                    class="w-8 h-8 rounded-lg bg-neu shadow-neu-out active:shadow-neu-in flex items-center justify-center text-green-500 transition">
                                    <x-heroicon-o-pencil-square class="w-4 h-4" />
                                </button>
                                <button wire:click="confirmDelete({{ $article->id }})"
                                    class="w-8 h-8 rounded-lg bg-neu shadow-neu-out active:shadow-neu-in flex items-center justify-center text-red-500 transition">
                                    <x-heroicon-o-trash class="w-4 h-4" />
                                </button>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr><td colspan="5" class="py-6 text-center text-gray-400">Belum ada artikel.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 pt-2">
            <p class="text-xs text-gray-400">
                Menampilkan {{ $articles->count() }} dari {{ $articles->total() }} artikel
            </p>
            {{ $articles->links('vendor.pagination.neu') }}
        </div>
    </div>

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
                        <option value="produk">Artikel Berita</option>
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

            <div>
                <label class="text-xs text-gray-500">Galeri Gambar (bisa lebih dari 1)</label>
                <input wire:model="galleryImages" type="file" multiple class="w-full text-sm">
                @error('galleryImages.*') <span class="text-xs text-red-500">{{ $message }}</span> @enderror

                {{-- Grid 2 kolom: gambar 1 & 2 sejajar di baris atas, gambar 3 otomatis turun ke baris bawah kiri --}}
                <div class="grid grid-cols-2 gap-2 mt-3">
                    @foreach($existingGallery as $index => $path)
                    <div class="relative">
                        <img src="{{ Storage::url($path) }}" class="w-full h-28 rounded-lg object-cover shadow-neu-in">
                        <button type="button" wire:click="removeExistingGalleryImage({{ $index }})"
                            class="absolute top-1 right-1 w-5 h-5 rounded-full bg-white/90 text-red-500 text-xs flex items-center justify-center shadow">
                            &times;
                        </button>
                    </div>
                    @endforeach

                    @foreach($galleryImages as $image)
                    <img src="{{ $image->temporaryUrl() }}" class="w-full h-28 rounded-lg object-cover shadow-neu-in">
                    @endforeach
                </div>
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
