<div class="space-y-6">

    {{-- Header --}}
    <div>
        <h1 class="text-2xl font-bold text-brand-blue">Sertifikat & Legalitas</h1>
        <p class="text-sm text-gray-500 mt-1">Simpan dokumen resmi komunitas agar tersedia dan mudah diverifikasi pengunjung</p>
    </div>

    {{-- Stat Cards --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 max-w-xl">
        <div class="bg-neu shadow-neu-out rounded-2xl p-5 flex flex-col gap-4">
            <div class="w-10 h-10 rounded-xl bg-blue-100 flex items-center justify-center">
                <x-heroicon-o-document-text class="w-5 h-5 text-brand-blue" />
            </div>
            <div>
                <p class="text-sm text-gray-400">Total Dokumen</p>
                <p class="text-2xl font-bold text-gray-700">{{ $legalities->total() }}</p>
            </div>
        </div>

        <div class="bg-neu shadow-neu-out rounded-2xl p-5 flex flex-col gap-4">
            <div class="w-10 h-10 rounded-xl bg-green-100 flex items-center justify-center">
                <x-heroicon-o-check-badge class="w-5 h-5 text-brand-green" />
            </div>
            <div>
                <p class="text-sm text-gray-400">Sertifikat Terverifikasi</p>
                <p class="text-2xl font-bold text-gray-700">{{ $totalTerverifikasi }}</p>
            </div>
        </div>
    </div>

    {{-- Main Card --}}
    <div class="bg-neu rounded-2xl shadow-neu-out p-6 space-y-6">

        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <h2 class="text-lg font-bold text-brand-blue">Daftar Sertifikat & Legalitas</h2>
            <button wire:click="create"
                class="bg-brand-green rounded-full shadow-neu-out active:shadow-neu-in px-5 py-2.5 text-sm font-medium text-white flex items-center gap-2 transition hover:opacity-90">
                <x-heroicon-o-plus class="w-4 h-4" />
                Tambah Dokumen
            </button>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead>
                    <tr class="text-left text-gray-400 border-b border-gray-100">
                        <th class="py-3 px-2 font-medium">Nama Dokumen</th>
                        <th class="py-3 px-2 font-medium">Kategori</th>
                        <th class="py-3 px-2 font-medium">Status</th>
                        <th class="py-3 px-2 font-medium text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($legalities as $legality)
                    <tr class="border-b border-gray-100 last:border-0">
                        <td class="py-4 px-2">
                            <p class="text-gray-700 font-medium">{{ $legality->nama_dokumen }}</p>
                            <p class="text-xs text-gray-400 font-mono mt-0.5">DOC-{{ str_pad($legality->id, 3, '0', STR_PAD_LEFT) }}</p>
                        </td>
                        <td class="py-4 px-2 text-gray-500">{{ $legality->kategori ?? '-' }}</td>
                        <td class="py-4 px-2">
                            @isset($legality->status)
                            <span class="inline-flex items-center gap-1.5 text-xs font-medium px-2.5 py-1 rounded-full
                                {{ $legality->status === 'sukses' ? 'bg-green-100 text-green-600' : 'bg-red-100 text-red-500' }}">
                                {{ $legality->status === 'sukses' ? 'Sukses' : 'Gagal' }}
                            </span>
                            @else
                            <span class="text-xs text-gray-300">-</span>
                            @endisset
                        </td>
                        <td class="py-4 px-2">
                            <div class="flex items-center justify-end gap-2">
                                <button wire:click="edit({{ $legality->id }})"
                                    class="w-8 h-8 rounded-lg bg-neu shadow-neu-out active:shadow-neu-in flex items-center justify-center text-brand-green transition">
                                    <x-heroicon-o-pencil-square class="w-4 h-4" />
                                </button>
                                <button wire:click="confirmDelete({{ $legality->id }})"
                                    class="w-8 h-8 rounded-lg bg-neu shadow-neu-out active:shadow-neu-in flex items-center justify-center text-red-500 transition">
                                    <x-heroicon-o-trash class="w-4 h-4" />
                                </button>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr><td colspan="4" class="py-6 text-center text-gray-400">Belum ada dokumen legalitas.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 pt-2">
            <p class="text-xs text-gray-400">
                Menampilkan {{ $legalities->count() }} dari {{ $legalities->total() }} dokumen
            </p>
            {{ $legalities->links('vendor.pagination.neu') }}
        </div>
    </div>

    {{-- Modal Tambah/Edit --}}
    @if($showModal)
    <div class="fixed inset-0 bg-black/40 flex items-center justify-center z-50 p-4">
        <div class="bg-white rounded-2xl shadow-xl p-6 w-full max-w-md space-y-5 relative">
            <button wire:click="$set('showModal', false)"
                class="absolute top-5 right-5 w-7 h-7 rounded-full bg-gray-100 flex items-center justify-center text-gray-500 hover:bg-gray-200 transition">
                <x-heroicon-o-x-mark class="w-4 h-4" />
            </button>

            <h2 class="text-lg font-bold text-brand-blue">{{ $legalityId ? 'Edit Sertifikan & Legalitas' : 'Tambah Sertifikan / Legalitas Baru' }}</h2>

            <div>
                <label class="text-xs text-gray-500 font-medium">Judul Sertifikat / Legalitas</label>
                <input wire:model="nama_dokumen" type="text" placeholder="Masukkan judul Sertifika / Legalitas"
                    class="w-full bg-white border border-gray-200 rounded-xl px-4 py-2.5 text-sm outline-none mt-1 focus:border-brand-green">
                @error('nama_dokumen') <span class="text-xs text-red-500">{{ $message }}</span> @enderror
            </div>

            <div>
                <label class="text-xs text-gray-500 font-medium">Kategori</label>
                <input wire:model="kategori" type="text" placeholder="Masukan Kategori"
                    class="w-full bg-white border border-gray-200 rounded-xl px-4 py-2.5 text-sm outline-none mt-1 focus:border-brand-green">
                @error('kategori') <span class="text-xs text-red-500">{{ $message }}</span> @enderror
            </div>

            <div>
                <label class="text-xs text-gray-500 font-medium">Unggah Gambar Utama</label>

                @if($file)
                <img src="{{ $file->temporaryUrl() }}" class="w-16 h-16 object-contain rounded-lg border border-gray-200 p-1 mt-2 mb-2">
                @elseif($existingFile)
                <img src="{{ Storage::url($existingFile) }}" class="w-16 h-16 object-contain rounded-lg border border-gray-200 p-1 mt-2 mb-2">
                @endif

                <label class="mt-1 flex flex-col items-center justify-center gap-2 border-2 border-dashed border-gray-200 rounded-xl py-8 cursor-pointer hover:border-brand-green transition">
                    <x-heroicon-o-arrow-up-tray class="w-6 h-6 text-brand-green" />
                    <span class="text-sm text-gray-500">Klik gambar ke sini</span>
                    <input wire:model="file" type="file" accept="image/*" class="hidden">
                </label>
                @error('file') <span class="text-xs text-red-500">{{ $message }}</span> @enderror
            </div>

            <div class="flex justify-end gap-3 pt-2">
                <button wire:click="$set('showModal', false)"
                    class="px-6 py-2.5 rounded-full border border-gray-200 text-sm font-medium text-gray-600 hover:bg-gray-50 transition">
                    Batal
                </button>
                <button wire:click="save"
                    class="bg-brand-green rounded-full px-6 py-2.5 text-sm font-medium text-white flex items-center gap-2 hover:opacity-90 transition">
                    <x-heroicon-o-check class="w-4 h-4" />
                    {{ $legalityId ? 'Edit' : 'Simpan' }}
                </button>
            </div>
        </div>
    </div>
    @endif

    {{-- Modal Hapus --}}
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
