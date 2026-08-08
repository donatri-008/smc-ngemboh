<div class="space-y-6 sm:space-y-8 max-w-6xl">
    @include('partials.admin-flash-messages')
    <div>
        <h1 class="text-xl sm:text-2xl lg:text-3xl font-bold text-blue-500">Kelola Info Lingkungan</h1>
        <p class="text-sm text-gray-600 mt-1">Kelola data dan foto anggota di tiap tim</p>
    </div>

    {{-- Stat Card --}}
    <x-ui.stat-card
        label="Total Deskripsi"
        :value="$totalDeskripsi"
        icon="document-text"
        class="w-full sm:w-64" />

    {{-- Table Card --}}
    <div class="bg-[#F9F9FF] rounded-2xl sm:rounded-[32px] shadow-[6px_6px_12px_#D1D9E6,-6px_-6px_12px_#FFFFFF] overflow-hidden">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 px-4 sm:px-8 py-5 sm:py-8">
            <h2 class="text-lg sm:text-2xl font-semibold text-blue-500">Daftar Deskripsi</h2>
            <div class="flex flex-col sm:flex-row items-stretch sm:items-center gap-3 sm:gap-4">
                <input wire:model.live.debounce.300ms="search" type="text" placeholder="Cari judul..."
                       class="w-full sm:w-48 bg-white rounded-xl px-4 py-2.5 text-sm shadow-[inset_4px_4px_8px_#D1D9E6,inset_-4px_-4px_8px_#FFFFFF] outline-none">
                <button wire:click="create"
                        class="flex items-center justify-center gap-2 bg-[#4CC71C] text-white px-4 py-2.5 rounded-xl text-sm font-medium shadow-[6px_6px_12px_#D1D9E6,-6px_-6px_12px_#FFFFFF] whitespace-nowrap">
                    <x-heroicon-o-plus class="w-5 h-5" />
                    Tambah Deskripsi
                </button>
            </div>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full min-w-[560px] text-sm table-fixed">
                <colgroup>
                    <col class="w-[28%]">
                    <col class="w-auto">
                    <col class="w-[110px]">
                </colgroup>
                <thead>
                    <tr class="text-left text-gray-500 border-b border-gray-200/40">
                        <th class="pl-4 sm:pl-8 py-2 font-bold text-base whitespace-nowrap">Judul Deskripsi</th>
                        <th class="px-4 sm:px-10 py-2 font-bold text-base whitespace-nowrap">Isi Deskripsi</th>
                        <th class="pr-4 sm:pr-8 py-2 font-bold text-base text-center whitespace-nowrap">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($infos as $info)
                    <tr class="border-b border-gray-100/60 last:border-0">
                        <td class="pl-4 sm:pl-8 py-6 sm:py-8 text-gray-900 font-bold align-top truncate">{{ $info->title }}</td>
                        <td class="py-6 sm:py-8 px-4 sm:px-10 text-gray-600 align-top truncate max-w-0">{{ $info->content }}</td>
                        <td class="pr-4 sm:pr-8 py-6 sm:py-8 align-top">
                            <div class="flex justify-center gap-2">
                                <button wire:click="edit({{ $info->id }})"
                                        class="w-9 h-9 rounded-lg bg-white shadow-[6px_6px_12px_#D1D9E6,-6px_-6px_12px_#FFFFFF] flex items-center justify-center">
                                    <x-heroicon-o-pencil-square class="w-[18px] h-[18px] text-[#4CC71C]" />
                                </button>
                                <button wire:click="confirmDelete({{ $info->id }})"
                                        class="w-9 h-9 rounded-lg bg-white shadow-[6px_6px_12px_#D1D9E6,-6px_-6px_12px_#FFFFFF] flex items-center justify-center">
                                    <x-heroicon-o-trash class="w-[18px] h-[18px] text-[#FF383C]" />
                                </button>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="3">
                            <x-ui.table-empty-state
                                icon="document-text"
                                title="Belum Ada Deskripsi Lingkungan"
                                message="Tambahkan deskripsi informasi lingkungan untuk ditampilkan di halaman publik.">
                            </x-ui.table-empty-state>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- Pagination --}}
        @if($infos->total() > 0)
        @php
            $current = $infos->currentPage();
            $last = $infos->lastPage();
            $window = [];
            for ($i = max(1, $current - 1); $i <= min($last, $current + 1); $i++) {
                $window[] = $i;
            }
        @endphp
        <div class="flex flex-col sm:flex-row items-center justify-between gap-4 px-4 sm:px-8 py-5 sm:py-8 border-t border-gray-200/40">
            <p class="text-xs sm:text-base text-[#717785] text-center sm:text-left">
                Menampilkan {{ $infos->count() }} dari {{ $infos->total() }} Deskripsi
            </p>

            {{-- Mobile: windowing nomor halaman, scrollable kalau perlu --}}
            <div class="flex sm:hidden items-center gap-2 overflow-x-auto max-w-full py-1">
                <button wire:click="previousPage" @if($infos->onFirstPage()) disabled @endif
                        class="w-9 h-9 shrink-0 rounded-xl bg-white shadow-[6px_6px_12px_#D1D9E6,-6px_-6px_12px_#FFFFFF] flex items-center justify-center disabled:opacity-40">
                    <x-heroicon-o-chevron-left class="w-3 h-3 text-[#717785]" />
                </button>

                @if($window[0] > 1)
                    <button wire:click="gotoPage(1)"
                            class="w-9 h-9 shrink-0 rounded-xl flex items-center justify-center text-xs bg-white shadow-[6px_6px_12px_#D1D9E6,-6px_-6px_12px_#FFFFFF] text-[#414754]">1</button>
                    @if($window[0] > 2)
                        <span class="w-5 shrink-0 flex items-center justify-center text-xs text-[#717785]">…</span>
                    @endif
                @endif

                @foreach($window as $i)
                <button wire:click="gotoPage({{ $i }})"
                        class="w-9 h-9 shrink-0 rounded-xl flex items-center justify-center text-xs
                            {{ $current == $i
                                    ? 'bg-white shadow-[inset_4px_4px_8px_#D1D9E6,inset_-4px_-4px_8px_#FFFFFF] text-[#4CC71C] font-bold'
                                    : 'bg-white shadow-[6px_6px_12px_#D1D9E6,-6px_-6px_12px_#FFFFFF] text-[#414754]' }}">
                    {{ $i }}
                </button>
                @endforeach

                @if(end($window) < $last)
                    @if(end($window) < $last - 1)
                        <span class="w-5 shrink-0 flex items-center justify-center text-xs text-[#717785]">…</span>
                    @endif
                    <button wire:click="gotoPage({{ $last }})"
                            class="w-9 h-9 shrink-0 rounded-xl flex items-center justify-center text-xs bg-white shadow-[6px_6px_12px_#D1D9E6,-6px_-6px_12px_#FFFFFF] text-[#414754]">{{ $last }}</button>
                @endif

                <button wire:click="nextPage" @if($infos->onLastPage()) disabled @endif
                        class="w-9 h-9 shrink-0 rounded-xl bg-white shadow-[6px_6px_12px_#D1D9E6,-6px_-6px_12px_#FFFFFF] flex items-center justify-center disabled:opacity-40">
                    <x-heroicon-o-chevron-right class="w-3 h-3 text-[#717785]" />
                </button>
            </div>

            {{-- Desktop: nomor halaman dengan windowing --}}
            <div class="hidden sm:flex items-center gap-2 flex-wrap justify-center">
                <button wire:click="previousPage" @if($infos->onFirstPage()) disabled @endif
                        class="w-10 h-10 shrink-0 rounded-xl bg-white shadow-[6px_6px_12px_#D1D9E6,-6px_-6px_12px_#FFFFFF] flex items-center justify-center disabled:opacity-40">
                    <x-heroicon-o-chevron-left class="w-3 h-3 text-[#717785]" />
                </button>

                @if($window[0] > 1)
                    <button wire:click="gotoPage(1)"
                            class="w-10 h-10 shrink-0 rounded-xl flex items-center justify-center text-sm bg-white shadow-[6px_6px_12px_#D1D9E6,-6px_-6px_12px_#FFFFFF] text-[#414754]">1</button>
                    @if($window[0] > 2)
                        <span class="w-10 h-10 shrink-0 flex items-center justify-center text-sm text-[#717785]">…</span>
                    @endif
                @endif

                @foreach($window as $i)
                <button wire:click="gotoPage({{ $i }})"
                        class="w-10 h-10 shrink-0 rounded-xl flex items-center justify-center text-sm
                            {{ $current == $i
                                    ? 'bg-white shadow-[inset_4px_4px_8px_#D1D9E6,inset_-4px_-4px_8px_#FFFFFF] text-[#4CC71C] font-bold'
                                    : 'bg-white shadow-[6px_6px_12px_#D1D9E6,-6px_-6px_12px_#FFFFFF] text-[#414754]' }}">
                    {{ $i }}
                </button>
                @endforeach

                @if(end($window) < $last)
                    @if(end($window) < $last - 1)
                        <span class="w-10 h-10 shrink-0 flex items-center justify-center text-sm text-[#717785]">…</span>
                    @endif
                    <button wire:click="gotoPage({{ $last }})"
                            class="w-10 h-10 shrink-0 rounded-xl flex items-center justify-center text-sm bg-white shadow-[6px_6px_12px_#D1D9E6,-6px_-6px_12px_#FFFFFF] text-[#414754]">{{ $last }}</button>
                @endif

                <button wire:click="nextPage" @if($infos->onLastPage()) disabled @endif
                        class="w-10 h-10 shrink-0 rounded-xl bg-white shadow-[6px_6px_12px_#D1D9E6,-6px_-6px_12px_#FFFFFF] flex items-center justify-center disabled:opacity-40">
                    <x-heroicon-o-chevron-right class="w-3 h-3 text-[#717785]" />
                </button>
            </div>
        </div>
        @endif
    </div>

    {{-- Modal Tambah/Edit --}}
    @if($showModal)
    <template x-teleport="body">
    <div wire:click.self="$set('showModal', false)" class="fixed inset-0 bg-black/30 backdrop-blur-sm flex items-center justify-center z-[9999] p-4">
        <div class="relative bg-[#F6F9FF] rounded-2xl sm:rounded-[32px] w-full max-w-[672px] max-h-[90vh] overflow-y-auto p-5 sm:p-8 space-y-5 sm:space-y-8">

            <button wire:click="$set('showModal', false)"
                    class="absolute right-4 top-4 sm:right-8 sm:top-8 w-9 h-9 sm:w-10 sm:h-10 rounded-full bg-white shadow-[4px_4px_8px_#BABECC,-4px_-4px_8px_#FFFFFF] flex items-center justify-center transition-transform active:scale-95">
                <x-heroicon-o-x-mark class="w-4 h-4 text-gray-600" />
            </button>

            <div class="space-y-2">
                <h2 class="text-xl sm:text-3xl font-bold text-blue-500 pr-10">
                    {{ $infoId ? 'Edit Info Lingkungan' : 'Tambah Info Lingkungan' }}
                </h2>
                <div class="w-16 h-1 bg-blue-500 rounded-full"></div>
            </div>

            <div class="space-y-2">
                <label class="text-xs font-semibold tracking-wide text-gray-600 uppercase">Judul Deskripsi</label>
                <input wire:model="title" type="text" placeholder="Masukkan Judul"
                       class="w-full bg-[#F6F9FF] rounded-2xl px-5 sm:px-6 py-3.5 sm:py-4 text-sm shadow-[inset_4px_4px_8px_#BABECC,inset_-4px_-4px_8px_#FFFFFF] outline-none placeholder-gray-400">
                @error('title') <span class="text-xs text-red-500">{{ $message }}</span> @enderror
            </div>

            <div class="space-y-2">
                <label class="text-xs font-semibold tracking-wide text-gray-600 uppercase">Isi Deskripsi</label>
                <textarea wire:model="content" rows="4" placeholder="Tuliskan isi deskripsi."
                          class="w-full bg-[#F6F9FF] rounded-2xl px-5 sm:px-6 py-3.5 sm:py-4 text-sm shadow-[inset_4px_4px_8px_#BABECC,inset_-4px_-4px_8px_#FFFFFF] outline-none placeholder-gray-400 resize-none"></textarea>
                @error('content') <span class="text-xs text-red-500">{{ $message }}</span> @enderror
            </div>

            <div class="flex flex-col sm:flex-row justify-end gap-3 sm:gap-6 pt-2 sm:pt-4">
                <button wire:click="$set('showModal', false)"
                        class="px-6 sm:px-10 py-3.5 sm:py-4 rounded-2xl bg-white shadow-[6px_6px_12px_#BABECC,-6px_-6px_12px_#FFFFFF] text-[#4CC71C] font-bold text-sm">
                    Batal
                </button>
                <button wire:click="save"
                        class="flex items-center justify-center gap-2 px-6 sm:px-10 py-3.5 sm:py-4 rounded-2xl bg-[#4CC71C] shadow-[6px_6px_12px_#BABECC,-6px_-6px_12px_#FFFFFF] text-white font-bold text-sm">
                    <x-heroicon-o-check class="w-4 h-4" />
                    Simpan
                </button>
            </div>
        </div>
    </div>
    </template>
    @endif

    {{-- Modal: Konfirmasi Hapus --}}
    @if($showDeleteModal)
    <template x-teleport="body">
    <div wire:click.self="$set('showDeleteModal', false)" class="fixed inset-0 bg-black/40 backdrop-blur-sm flex items-center justify-center z-[9999] p-4"
        x-data x-transition.opacity>
        <div class="bg-[#F6F9FF] rounded-2xl sm:rounded-[32px] w-full max-w-[420px] p-5 sm:p-10 text-center space-y-5 sm:space-y-6"
            x-transition:enter="transition ease-out duration-200"
            x-transition:enter-start="opacity-0 scale-95"
            x-transition:enter-end="opacity-100 scale-100">

            <div class="w-14 h-14 sm:w-16 sm:h-16 rounded-full bg-red-50 shadow-[inset_4px_4px_8px_#F3D4D4,inset_-4px_-4px_8px_#FFFFFF] flex items-center justify-center mx-auto">
                <x-heroicon-o-exclamation-triangle class="w-6 h-6 sm:w-7 sm:h-7 text-[#FF383C]" />
            </div>

            <div class="space-y-2">
                <p class="text-[#181C23] text-lg sm:text-xl font-bold">Hapus Deskripsi Ini?</p>
                <p class="text-[#717785] text-sm leading-relaxed break-words">
                    Deskripsi <span class="font-bold text-[#181C23]">"{{ $deleteTitle }}"</span> akan dihapus permanen dan tidak dapat dikembalikan.
                </p>
            </div>

            <div class="flex gap-3 sm:gap-4 pt-2">
                <button wire:click="$set('showDeleteModal', false)"
                        class="flex-1 bg-white shadow-[6px_6px_12px_#D1D9E6,-6px_-6px_12px_#FFFFFF] rounded-2xl px-4 sm:px-6 py-3 sm:py-3.5 text-[#414754] font-semibold text-sm transition-transform active:scale-95 hover:shadow-[4px_4px_8px_#D1D9E6,-4px_-4px_8px_#FFFFFF]">
                    Batal
                </button>
                <button wire:click="delete"
                        class="flex-1 flex items-center justify-center gap-2 bg-[#FF383C] shadow-[6px_6px_12px_#D1D9E6,-6px_-6px_12px_#FFFFFF] rounded-2xl px-4 sm:px-6 py-3 sm:py-3.5 text-white font-semibold text-sm transition-transform active:scale-95 hover:bg-[#e6302f]">
                    <x-heroicon-o-trash class="w-4 h-4" />
                    Ya, Hapus
                </button>
            </div>
        </div>
    </div>
    </template>
    @endif
</div>