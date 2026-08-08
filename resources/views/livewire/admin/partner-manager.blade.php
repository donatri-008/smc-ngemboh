<<<<<<< HEAD
<div class="space-y-6 sm:space-y-8 max-w-6xl">
    @include('partials.admin-flash-messages')

    {{-- Header --}}
    <div>
        <h1 class="text-xl sm:text-2xl lg:text-3xl font-bold text-[#2681FA]">Kelola Mitra</h1>
        <p class="text-sm sm:text-base text-[#414754] mt-1">Kelola logo dan tautan mitra kerja sama yang tampil di halaman Tentang Kami.</p>
    </div>

    {{-- Stat Card --}}
    <x-ui.stat-card
        label="Total Mitra"
        :value="$partners->total()"
        icon="building-office-2"
        class="w-full sm:w-64" />

    {{-- Table Card --}}
    <div class="bg-[#F9F9FF] rounded-2xl sm:rounded-[32px] shadow-[6px_6px_12px_#D1D9E6,-6px_-6px_12px_#FFFFFF] overflow-hidden">

        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 px-4 sm:px-8 py-5 sm:py-8 border-b border-[#E0E2EC]/30">
            <h2 class="text-lg sm:text-2xl font-semibold text-[#2681FA]">Daftar Mitra</h2>
            <div class="flex flex-col sm:flex-row items-stretch sm:items-center gap-3 sm:gap-4">
                <div class="relative w-full sm:w-56">
                    <x-heroicon-o-magnifying-glass class="w-[18px] h-[18px] text-[#717785] absolute left-4 top-1/2 -translate-y-1/2 pointer-events-none" />
                    <input wire:model.live.debounce.300ms="search" type="text" placeholder="Cari nama mitra..."
                           class="w-full bg-white shadow-[inset_4px_4px_8px_#D1D9E6,inset_-4px_-4px_8px_#FFFFFF] rounded-xl pl-11 pr-4 py-2.5 text-sm text-[#181C23] placeholder:text-[#6B7280] outline-none">
                </div>
                <button wire:click="create"
                        class="flex items-center justify-center gap-2 bg-[#4CC71C] shadow-[6px_6px_12px_#D1D9E6,-6px_-6px_12px_#FFFFFF] rounded-xl px-5 py-2.5 text-sm text-white font-medium whitespace-nowrap transition-transform active:scale-95">
                    <x-heroicon-o-plus class="w-5 h-5" />
                    Tambah Mitra
                </button>
            </div>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full min-w-[560px] text-sm table-fixed">
                <colgroup>
                    <col class="w-[76px]">
                    <col class="w-[34%]">
                    <col class="w-auto">
                    <col class="w-[120px]">
                </colgroup>
                <thead>
                    <tr class="text-left text-[#717785] border-b border-[#E0E2EC]/30">
                        <th class="pl-4 sm:pl-8 py-4 font-bold text-base whitespace-nowrap" colspan="2">Nama Mitra</th>
                        <th class="px-2 py-4 font-bold text-base whitespace-nowrap">Link</th>
                        <th class="pr-4 sm:pr-8 py-4 font-bold text-base text-center whitespace-nowrap">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($partners as $partner)
                    <tr class="border-b border-[#E0E2EC]/30 last:border-0 align-middle">
                        <td class="pl-4 sm:pl-8 py-5">
                            @if($partner->logo)
                            <img src="{{ Storage::url($partner->logo) }}" class="w-12 h-12 rounded-xl object-contain bg-white shadow-sm p-1.5">
                            @else
                            <div class="w-12 h-12 rounded-xl bg-[#e5e7eab5] flex items-center justify-center">
                                <x-heroicon-o-photo class="w-5 h-5 text-gray-400" />
                            </div>
                            @endif
                        </td>
                        <td class="py-5 px-2 font-bold text-[#181C23] truncate">{{ $partner->nama }}</td>
                        <td class="py-5 px-2 text-[#2681FA] truncate">
                            @if($partner->link)
                            <a href="{{ $partner->link }}" target="_blank" class="hover:underline">{{ $partner->link }}</a>
                            @else
                            <span class="text-[#8A93A6]">-</span>
                            @endif
                        </td>
                        <td class="pr-4 sm:pr-8 py-5">
                            <div class="flex items-center justify-center gap-2">
                                <button wire:click="edit({{ $partner->id }})"
                                        class="w-9 h-9 shrink-0 rounded-lg bg-white shadow-[6px_6px_12px_#D1D9E6,-6px_-6px_12px_#FFFFFF] flex items-center justify-center transition-transform active:scale-95">
                                    <x-heroicon-o-pencil-square class="w-[18px] h-[18px] text-[#4CC71C]" />
                                </button>
                                <button wire:click="confirmDelete({{ $partner->id }})"
                                        class="w-9 h-9 shrink-0 rounded-lg bg-white shadow-[6px_6px_12px_#D1D9E6,-6px_-6px_12px_#FFFFFF] flex items-center justify-center transition-transform active:scale-95">
                                    <x-heroicon-o-trash class="w-[18px] h-[18px] text-[#FF383C]" />
                                </button>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4">
                            <x-ui.table-empty-state
                                icon="building-office-2"
                                title="Belum Ada Mitra"
                                message="Tambahkan mitra kerja sama pertama untuk ditampilkan di halaman Tentang Kami.">
                            </x-ui.table-empty-state>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- Pagination --}}
        @if($partners->total() > 0)
        @php
            $current = $partners->currentPage();
            $last = $partners->lastPage();
            $window = [];
            for ($i = max(1, $current - 1); $i <= min($last, $current + 1); $i++) { $window[] = $i; }
        @endphp
        <div class="flex flex-col sm:flex-row items-center justify-between gap-4 px-4 sm:px-8 py-5 sm:py-8 border-t border-[#E0E2EC]/30">
            <p class="text-xs sm:text-base text-[#717785] text-center sm:text-left">
                Menampilkan {{ $partners->count() }} dari {{ $partners->total() }} Mitra
            </p>

            <div class="flex sm:hidden items-center gap-2 overflow-x-auto max-w-full py-1">
                <button wire:click="previousPage" @if($partners->onFirstPage()) disabled @endif
                        class="w-9 h-9 shrink-0 rounded-xl bg-white shadow-[6px_6px_12px_#D1D9E6,-6px_-6px_12px_#FFFFFF] flex items-center justify-center disabled:opacity-40">
                    <x-heroicon-o-chevron-left class="w-3 h-3 text-[#717785]" />
                </button>
                @if($window[0] > 1)
                    <button wire:click="gotoPage(1)" class="w-9 h-9 shrink-0 rounded-xl flex items-center justify-center text-xs bg-white shadow-[6px_6px_12px_#D1D9E6,-6px_-6px_12px_#FFFFFF] text-[#414754]">1</button>
                    @if($window[0] > 2)<span class="w-5 shrink-0 flex items-center justify-center text-xs text-[#717785]">…</span>@endif
                @endif
                @foreach($window as $i)
                <button wire:click="gotoPage({{ $i }})"
                        class="w-9 h-9 shrink-0 rounded-xl flex items-center justify-center text-xs
                            {{ $current == $i ? 'bg-white shadow-[inset_4px_4px_8px_#D1D9E6,inset_-4px_-4px_8px_#FFFFFF] text-[#4CC71C] font-bold' : 'bg-white shadow-[6px_6px_12px_#D1D9E6,-6px_-6px_12px_#FFFFFF] text-[#414754]' }}">
                    {{ $i }}
                </button>
                @endforeach
                @if(end($window) < $last)
                    @if(end($window) < $last - 1)<span class="w-5 shrink-0 flex items-center justify-center text-xs text-[#717785]">…</span>@endif
                    <button wire:click="gotoPage({{ $last }})" class="w-9 h-9 shrink-0 rounded-xl flex items-center justify-center text-xs bg-white shadow-[6px_6px_12px_#D1D9E6,-6px_-6px_12px_#FFFFFF] text-[#414754]">{{ $last }}</button>
                @endif
                <button wire:click="nextPage" @if($partners->onLastPage()) disabled @endif
                        class="w-9 h-9 shrink-0 rounded-xl bg-white shadow-[6px_6px_12px_#D1D9E6,-6px_-6px_12px_#FFFFFF] flex items-center justify-center disabled:opacity-40">
                    <x-heroicon-o-chevron-right class="w-3 h-3 text-[#717785]" />
                </button>
            </div>

            <div class="hidden sm:flex items-center gap-2 flex-wrap justify-center">
                <button wire:click="previousPage" @if($partners->onFirstPage()) disabled @endif
                        class="w-10 h-10 shrink-0 rounded-xl bg-white shadow-[6px_6px_12px_#D1D9E6,-6px_-6px_12px_#FFFFFF] flex items-center justify-center disabled:opacity-40">
                    <x-heroicon-o-chevron-left class="w-3 h-3 text-[#717785]" />
                </button>
                @if($window[0] > 1)
                    <button wire:click="gotoPage(1)" class="w-10 h-10 shrink-0 rounded-xl flex items-center justify-center text-sm bg-white shadow-[6px_6px_12px_#D1D9E6,-6px_-6px_12px_#FFFFFF] text-[#414754]">1</button>
                    @if($window[0] > 2)<span class="w-10 h-10 shrink-0 flex items-center justify-center text-sm text-[#717785]">…</span>@endif
                @endif
                @foreach($window as $i)
                <button wire:click="gotoPage({{ $i }})"
                        class="w-10 h-10 shrink-0 rounded-xl flex items-center justify-center text-sm
                            {{ $current == $i ? 'bg-white shadow-[inset_4px_4px_8px_#D1D9E6,inset_-4px_-4px_8px_#FFFFFF] text-[#4CC71C] font-bold' : 'bg-white shadow-[6px_6px_12px_#D1D9E6,-6px_-6px_12px_#FFFFFF] text-[#414754]' }}">
                    {{ $i }}
                </button>
                @endforeach
                @if(end($window) < $last)
                    @if(end($window) < $last - 1)<span class="w-10 h-10 shrink-0 flex items-center justify-center text-sm text-[#717785]">…</span>@endif
                    <button wire:click="gotoPage({{ $last }})" class="w-10 h-10 shrink-0 rounded-xl flex items-center justify-center text-sm bg-white shadow-[6px_6px_12px_#D1D9E6,-6px_-6px_12px_#FFFFFF] text-[#414754]">{{ $last }}</button>
                @endif
                <button wire:click="nextPage" @if($partners->onLastPage()) disabled @endif
                        class="w-10 h-10 shrink-0 rounded-xl bg-white shadow-[6px_6px_12px_#D1D9E6,-6px_-6px_12px_#FFFFFF] flex items-center justify-center disabled:opacity-40">
                    <x-heroicon-o-chevron-right class="w-3 h-3 text-[#717785]" />
                </button>
            </div>
        </div>
        @endif
    </div>

    {{-- Modal: Tambah / Edit --}}
    @if($showModal)
    <template x-teleport="body">
    <div wire:click.self="$set('showModal', false)" class="fixed inset-0 bg-black/30 backdrop-blur-sm flex items-center justify-center z-[9999] p-4">
        <div class="relative bg-[#F6F9FF] rounded-2xl sm:rounded-[32px] w-full max-w-[520px] max-h-[90vh] overflow-y-auto p-5 sm:p-8 space-y-5 sm:space-y-8">

            <button wire:click="$set('showModal', false)"
                    class="absolute right-4 top-4 sm:right-8 sm:top-8 w-9 h-9 sm:w-10 sm:h-10 rounded-full bg-white shadow-[4px_4px_8px_#BABECC,-4px_-4px_8px_#FFFFFF] flex items-center justify-center transition-transform active:scale-95">
                <x-heroicon-o-x-mark class="w-[14px] h-[14px] text-[#40484B]" />
            </button>

            <div>
                <h2 class="text-xl sm:text-3xl font-bold text-[#2681FA] pr-10">{{ $partnerId ? 'Edit Mitra' : 'Tambah Mitra Baru' }}</h2>
                <div class="w-16 h-1 bg-[#2681FA] rounded-full mt-2"></div>
            </div>

            <div class="space-y-5 sm:space-y-6">
                <div>
                    <label class="text-[13px] font-semibold tracking-wide text-[#40484B]">Nama Mitra</label>
                    <input wire:model="nama" type="text" placeholder="Masukkan nama mitra"
                        class="w-full mt-2 bg-[#F6F9FF] shadow-[inset_4px_4px_8px_#BABECC,inset_-4px_-4px_8px_#FFFFFF] rounded-2xl px-5 sm:px-6 py-3.5 sm:py-4 text-sm text-[#181C23] placeholder:text-[#BFC8CB] outline-none">
                    @error('nama') <span class="text-xs text-red-500">{{ $message }}</span> @enderror
                </div>

                <div>
                    <label class="text-[13px] font-semibold tracking-wide text-[#40484B]">Link (opsional)</label>
                    <input wire:model="link" type="text" placeholder="https://..."
                        class="w-full mt-2 bg-[#F6F9FF] shadow-[inset_4px_4px_8px_#BABECC,inset_-4px_-4px_8px_#FFFFFF] rounded-2xl px-5 sm:px-6 py-3.5 sm:py-4 text-sm text-[#181C23] placeholder:text-[#BFC8CB] outline-none">
                    @error('link') <span class="text-xs text-red-500">{{ $message }}</span> @enderror
                </div>

                <div>
                    <label class="text-[13px] font-semibold tracking-wide text-[#40484B]">Logo</label>
                    <input wire:model="logo" type="file" class="w-full mt-2 text-sm">
                    @error('logo') <span class="text-xs text-red-500">{{ $message }}</span> @enderror

                    @if($logo)
                    <img src="{{ $logo->temporaryUrl() }}" class="w-16 h-16 object-contain mt-3 shadow-[inset_2px_2px_4px_#BABECC] rounded-xl p-2 bg-white">
                    @elseif($existingLogo)
                    <img src="{{ Storage::url($existingLogo) }}" class="w-16 h-16 object-contain mt-3 shadow-[inset_2px_2px_4px_#BABECC] rounded-xl p-2 bg-white">
                    @endif
                </div>
            </div>

            <div class="flex flex-col sm:flex-row justify-end gap-3 sm:gap-6 pt-2">
                <button wire:click="$set('showModal', false)"
                        class="bg-white shadow-[6px_6px_12px_#BABECC,-6px_-6px_12px_#FFFFFF] rounded-2xl px-6 sm:px-10 py-3.5 sm:py-4 text-[#4CC71C] font-bold transition-transform active:scale-95">
                    Batal
                </button>
                <button wire:click="save"
                        class="flex items-center justify-center gap-2 bg-[#4CC71C] shadow-[6px_6px_12px_#BABECC,-6px_-6px_12px_#FFFFFF] rounded-2xl px-6 sm:px-10 py-3.5 sm:py-4 text-white font-bold transition-transform active:scale-95">
                    <x-heroicon-o-check class="w-[14px] h-[14px]" />
                    Simpan
                </button>
=======
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

>>>>>>> 7c2b0c38c7cbb0458913dc97ac2a87842c5a8228
            </div>

        </div>
    </div>
    </template>
    @endif

<<<<<<< HEAD
    {{-- Modal: Konfirmasi Hapus --}}
    @if($showDeleteModal)
    <template x-teleport="body">
    <div wire:click.self="$set('showDeleteModal', false)" class="fixed inset-0 bg-black/30 backdrop-blur-sm flex items-center justify-center z-[9999] p-4"
        x-data x-transition.opacity>
        <div class="bg-[#F6F9FF] rounded-2xl sm:rounded-[32px] w-full max-w-[420px] p-5 sm:p-10 text-center space-y-5 sm:space-y-6"
            x-transition:enter="transition ease-out duration-200"
            x-transition:enter-start="opacity-0 scale-95"
            x-transition:enter-end="opacity-100 scale-100">

            <div class="w-14 h-14 sm:w-16 sm:h-16 rounded-full bg-red-50 shadow-[inset_4px_4px_8px_#F3D4D4,inset_-4px_-4px_8px_#FFFFFF] flex items-center justify-center mx-auto">
                <x-heroicon-o-exclamation-triangle class="w-6 h-6 sm:w-7 sm:h-7 text-[#FF383C]" />
            </div>

            <div class="space-y-2">
                <p class="text-[#181C23] text-lg sm:text-xl font-bold">Hapus Mitra Ini?</p>
                <p class="text-[#717785] text-sm leading-relaxed">Data mitra ini akan dihapus permanen dan tidak dapat dikembalikan.</p>
            </div>

            <div class="flex gap-3 sm:gap-4 pt-2">
                <button wire:click="$set('showDeleteModal', false)"
                        class="flex-1 bg-white shadow-[6px_6px_12px_#D1D9E6,-6px_-6px_12px_#FFFFFF] rounded-2xl px-4 sm:px-6 py-3 sm:py-3.5 text-[#414754] font-semibold text-sm transition-transform active:scale-95">
                    Batal
                </button>
                <button wire:click="delete"
                        class="flex-1 flex items-center justify-center gap-2 bg-[#FF383C] shadow-[6px_6px_12px_#D1D9E6,-6px_-6px_12px_#FFFFFF] rounded-2xl px-4 sm:px-6 py-3 sm:py-3.5 text-white font-semibold text-sm transition-transform active:scale-95">
                    <x-heroicon-o-trash class="w-4 h-4" />
                    Ya, Hapus
                </button>
=======
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

>>>>>>> 7c2b0c38c7cbb0458913dc97ac2a87842c5a8228
            </div>

        </div>
    </div>
    </template>
    @endif

</div>
