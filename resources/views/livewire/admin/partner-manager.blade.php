<div class="space-y-6">

    {{-- Header --}}
    <div>
        <h1 class="text-2xl font-bold text-brand-blue">Kelola Media Patner</h1>
        <p class="text-sm text-gray-500 mt-1">Kelola data dan foto anggota di tiap tim</p>
    </div>

    {{-- Stat Card --}}
    <div class="bg-neu shadow-neu-out rounded-2xl p-4 flex flex-col gap-3 w-full sm:w-56">
        <div class="w-9 h-9 rounded-xl bg-blue-100 flex items-center justify-center">
            <x-heroicon-o-clipboard-document-list class="w-4 h-4 text-brand-blue" />
        </div>

        <div>
            <p class="text-sm text-gray-400">Total Anggota</p>
            <p class="text-xl font-bold text-gray-700">{{ $partners->total() }}</p>
        </div>
    </div>

    {{-- Main Card --}}
    <div class="flex justify-center">
        <div class="bg-neu rounded-2xl shadow-neu-out p-6 space-y-4 w-full max-w-5xl">

            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                <h2 class="text-base font-bold text-brand-blue">Daftar Media Patner</h2>

                <button wire:click="create"
                    class="bg-brand-green rounded-full shadow-neu-out active:shadow-neu-in px-4 py-2 text-sm font-medium text-white flex items-center gap-2 transition hover:opacity-90">
                    <x-heroicon-o-plus class="w-4 h-4" />
                    Tambah Media
                </button>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full text-sm">
                    <thead>
                        <tr class="text-left text-gray-400 border-b border-gray-100">
                            <th class="py-3 px-2 font-medium">Nama Mitra</th>
                            <th class="py-3 px-2 font-medium">Logo</th>
                            <th class="py-3 px-2 font-medium text-right">Aksi</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse($partners as $partner)
                        <tr class="border-b border-gray-100 last:border-0">
                            <td class="py-4 px-2 text-gray-700 font-medium">
                                {{ $partner->nama }}
                            </td>

                            <td class="py-4 px-2">
                                @if($partner->logo)
                                <img src="{{ Storage::url($partner->logo) }}"
                                    class="w-12 h-12 rounded-lg object-contain bg-white shadow-neu-in p-1">
                                @else
                                <div class="w-12 h-12 rounded-lg bg-neu shadow-neu-in"></div>
                                @endif
                            </td>

                            <td class="py-4 px-2">
                                <div class="flex items-center justify-end gap-2">

                                    <button
                                        wire:click="edit({{ $partner->id }})"
                                        class="w-8 h-8 rounded-lg bg-neu shadow-neu-out active:shadow-neu-in flex items-center justify-center text-brand-green transition">
                                        <x-heroicon-o-pencil-square class="w-4 h-4" />
                                    </button>

                                    <button
                                        wire:click="confirmDelete({{ $partner->id }})"
                                        class="w-8 h-8 rounded-lg bg-neu shadow-neu-out active:shadow-neu-in flex items-center justify-center text-red-500 transition">
                                        <x-heroicon-o-trash class="w-4 h-4" />
                                    </button>

                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="3" class="py-6 text-center text-gray-400">
                                Belum ada mitra.
                            </td>
                        </tr>
                        @endforelse
                    </tbody>

                </table>
            </div>

            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 pt-2">

                <p class="text-xs text-gray-400">
                    Menampilkan {{ $partners->count() }} dari {{ $partners->total() }} Mitra
                </p>

                {{ $partners->links('vendor.pagination.neu') }}

            </div>

        </div>
    </div>

    {{-- Modal Tambah/Edit --}}
    @if($showModal)
    <div class="fixed inset-0 bg-black/40 flex items-center justify-center z-50 p-4">

        <div class="bg-white rounded-2xl shadow-xl p-6 w-full max-w-md space-y-5 relative">

            <button
                wire:click="$set('showModal', false)"
                class="absolute top-5 right-5 w-7 h-7 rounded-full bg-gray-100 flex items-center justify-center text-gray-500 hover:bg-gray-200 transition">
                <x-heroicon-o-x-mark class="w-4 h-4" />
            </button>

            <h2 class="text-lg font-bold text-brand-blue">
                {{ $partnerId ? 'Edit Media Patner' : 'Tambah Media Patner' }}
            </h2>

            <div>
                <label class="text-xs text-gray-500 font-medium">
                    Nama Mitra
                </label>

                <input
                    wire:model="nama"
                    type="text"
                    placeholder="Masukkan nama Mitra"
                    class="w-full bg-white border border-gray-200 rounded-xl px-4 py-2.5 text-sm outline-none mt-1 focus:border-brand-green">

                @error('nama')
                <span class="text-xs text-red-500">{{ $message }}</span>
                @enderror
            </div>

            <div>

                <label class="text-xs text-gray-500 font-medium">
                    Unggah Logo Mitra
                </label>

                @if($logo)
                <img src="{{ $logo->temporaryUrl() }}"
                    class="w-16 h-16 object-contain rounded-lg border border-gray-200 p-1 mt-2 mb-2">

                @elseif($existingLogo)

                <img src="{{ Storage::url($existingLogo) }}"
                    class="w-16 h-16 object-contain rounded-lg border border-gray-200 p-1 mt-2 mb-2">

                @endif

                <label class="mt-1 flex flex-col items-center justify-center gap-2 border-2 border-dashed border-gray-200 rounded-xl py-8 cursor-pointer hover:border-brand-green transition">

                    <x-heroicon-o-arrow-up-tray class="w-6 h-6 text-brand-green" />

                    <span class="text-sm text-gray-500">
                        Klik gambar ke sini
                    </span>

                    <input
                        wire:model="logo"
                        type="file"
                        accept="image/*"
                        class="hidden">

                </label>

                @error('logo')
                <span class="text-xs text-red-500">{{ $message }}</span>
                @enderror

            </div>

            <div class="flex justify-end gap-3 pt-2">

                <button
                    wire:click="$set('showModal', false)"
                    class="px-6 py-2.5 rounded-full border border-gray-200 text-sm font-medium text-gray-600 hover:bg-gray-50 transition">
                    Batal
                </button>

                <button
                    wire:click="save"
                    class="bg-brand-green rounded-full px-6 py-2.5 text-sm font-medium text-white flex items-center gap-2 hover:opacity-90 transition">

                    <x-heroicon-o-check class="w-4 h-4" />

                    {{ $partnerId ? 'Edit' : 'Simpan' }}

                </button>

            </div>

        </div>
    </div>
    @endif

    {{-- Modal Hapus --}}
    @if($showDeleteModal)
    <div class="fixed inset-0 bg-black/30 flex items-center justify-center z-50 p-4">

        <div class="bg-neu rounded-2xl shadow-neu-out p-6 w-full max-w-sm space-y-4 text-center">

            <p class="text-gray-700">
                Yakin ingin menghapus mitra ini?
            </p>

            <div class="flex justify-center gap-3">

                <button
                    wire:click="$set('showDeleteModal', false)"
                    class="px-4 py-2 text-sm text-gray-500">
                    Batal
                </button>

                <button
                    wire:click="delete"
                    class="bg-neu rounded-xl shadow-neu-out active:shadow-neu-in px-5 py-2 text-sm font-medium text-red-500">
                    Hapus
                </button>

            </div>

        </div>
    </div>
    @endif

</div>
