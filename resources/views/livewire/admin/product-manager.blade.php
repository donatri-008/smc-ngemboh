<div class="space-y-6 sm:space-y-8 max-w-6xl">
    @include('partials.admin-flash-messages')

    {{-- Header --}}
    <div>
        <h1 class="text-xl sm:text-2xl lg:text-3xl font-bold text-[#2681FA]">Kelola Produk</h1>
        <p class="text-sm sm:text-base text-[#414754] mt-1">Atur produk yang dijual di halaman Belanja mulai harga, stok, dan gambar selalu bisa diperbarui di sini.</p>
    </div>

    {{-- Stat Card --}}
    <x-ui.stat-card
        label="Total Produk"
        :value="$products->total()"
        icon="shopping-bag"
        class="w-full sm:w-64" />

    {{-- Table Card --}}
    <div class="bg-[#F9F9FF] rounded-2xl sm:rounded-[32px] shadow-[6px_6px_12px_#D1D9E6,-6px_-6px_12px_#FFFFFF] overflow-hidden">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 px-4 sm:px-8 py-5 sm:py-8 border-b border-[#E0E2EC]/30">
            <h2 class="text-lg sm:text-2xl font-semibold text-[#2681FA]">Daftar Produk</h2>
            <div class="flex flex-col sm:flex-row items-stretch sm:items-center gap-3 flex-wrap">
                <input wire:model.live.debounce.300ms="search" type="text" placeholder="Cari nama produk..."
                       class="w-full sm:w-48 bg-white shadow-[inset_4px_4px_8px_#D1D9E6,inset_-4px_-4px_8px_#FFFFFF] rounded-xl px-4 py-2.5 text-sm outline-none">
                <button wire:click="create"
                        class="flex items-center justify-center gap-2 bg-[#4CC71C] text-white px-4 py-2.5 rounded-xl text-sm font-medium shadow-[6px_6px_12px_#D1D9E6,-6px_-6px_12px_#FFFFFF] whitespace-nowrap transition-transform active:scale-95">
                    <x-heroicon-o-plus class="w-5 h-5" />
                    Tambah Produk
                </button>
            </div>
        </div>

        {{-- Table: overflow-x-auto + min-w memberi ruang scroll horizontal yang rapi di layar sempit --}}
        <div class="overflow-x-auto">
            <table class="w-full min-w-[820px] text-sm table-fixed">
                <colgroup>
                    <col class="w-[76px]">
                    <col class="w-[24%]">
                    <col class="w-[14%]">
                    <col class="w-[24%]">
                    <col class="w-[16%]">
                    <col class="w-[110px]">
                </colgroup>
                <thead>
                    <tr class="text-left text-[#717785] border-b border-[#E0E2EC]/30">
                        <th class="pl-4 sm:pl-8 py-4 font-bold text-base whitespace-nowrap" colspan="2">Nama Produk</th>
                        <th class="px-2 py-4 font-bold text-base whitespace-nowrap">Stok Produk</th>
                        <th class="px-2 py-4 font-bold text-base whitespace-nowrap">Deskripsi</th>
                        <th class="px-2 py-4 font-bold text-base whitespace-nowrap">Harga</th>
                        <th class="pr-4 sm:pr-8 py-4 font-bold text-base text-center whitespace-nowrap">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($products as $product)
                    <tr class="border-b border-[#E0E2EC]/30 last:border-0 align-middle">
                        <td class="pl-4 sm:pl-8 py-5">
                            @if($product->gambar)
                            <img src="{{ Storage::url($product->gambar) }}" class="w-12 h-12 rounded-xl object-cover shadow-sm">
                            @else
                            <div class="w-12 h-12 rounded-xl bg-[#e5e7eab5] flex items-center justify-center">
                                <x-heroicon-o-photo class="w-5 h-5 text-gray-400" />
                            </div>
                            @endif
                        </td>
                        <td class="py-5 px-2 font-bold text-[#181C23] truncate">{{ $product->nama }}</td>
                        <td class="py-5 px-2">
                            <span class="inline-block px-3 sm:px-4 py-1.5 rounded-full text-xs sm:text-sm font-medium text-white bg-[#4CC71C]">
                                {{ $product->stok }}
                            </span>
                        </td>
                        <td class="py-5 px-2 text-[#414754] truncate">
                            {{ Str::limit($product->deskripsi, 40) ?: '-' }}
                        </td>
                        <td class="py-5 px-2 font-semibold text-[#2681FA] truncate">Rp. {{ number_format($product->harga, 0, ',', '.') }}</td>
                        <td class="pr-4 sm:pr-8 py-5">
                            <div class="flex items-center justify-center gap-2">
                                <button wire:click="edit({{ $product->id }})"
                                        class="w-9 h-9 rounded-lg bg-white shadow-[6px_6px_12px_#D1D9E6,-6px_-6px_12px_#FFFFFF] flex items-center justify-center transition-transform active:scale-95">
                                    <x-heroicon-o-pencil-square class="w-[18px] h-[18px] text-[#4CC71C]" />
                                </button>
                                <button wire:click="confirmDelete({{ $product->id }})"
                                        class="w-9 h-9 rounded-lg bg-white shadow-[6px_6px_12px_#D1D9E6,-6px_-6px_12px_#FFFFFF] flex items-center justify-center transition-transform active:scale-95">
                                    <x-heroicon-o-trash class="w-4 h-[18px] text-[#FF383C]" />
                                </button>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6">
                            <x-ui.table-empty-state
                                icon="shopping-bag"
                                title="Belum Ada Produk"
                                message="Tambahkan produk pertama untuk ditampilkan di halaman Belanja.">
                            </x-ui.table-empty-state>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- Pagination --}}
        @if($products->total() > 0)
        @php
            $current = $products->currentPage();
            $last = $products->lastPage();
            $window = [];
            for ($i = max(1, $current - 1); $i <= min($last, $current + 1); $i++) {
                $window[] = $i;
            }
        @endphp
        <div class="flex flex-col sm:flex-row items-center justify-between gap-4 px-4 sm:px-8 py-5 sm:py-8 border-t border-[#E0E2EC]/30">
            <p class="text-xs sm:text-base text-[#717785] text-center sm:text-left">
                Menampilkan {{ $products->count() }} dari {{ $products->total() }} Produk
            </p>

            {{-- Mobile: windowing nomor halaman, scrollable kalau perlu --}}
            <div class="flex sm:hidden items-center gap-2 overflow-x-auto max-w-full py-1">
                <button wire:click="previousPage" @if($products->onFirstPage()) disabled @endif
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

                <button wire:click="nextPage" @if($products->onLastPage()) disabled @endif
                        class="w-9 h-9 shrink-0 rounded-xl bg-white shadow-[6px_6px_12px_#D1D9E6,-6px_-6px_12px_#FFFFFF] flex items-center justify-center disabled:opacity-40">
                    <x-heroicon-o-chevron-right class="w-3 h-3 text-[#717785]" />
                </button>
            </div>

            {{-- Desktop: nomor halaman dengan windowing --}}
            <div class="hidden sm:flex items-center gap-2 flex-wrap justify-center">
                <button wire:click="previousPage" @if($products->onFirstPage()) disabled @endif
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

                <button wire:click="nextPage" @if($products->onLastPage()) disabled @endif
                        class="w-10 h-10 shrink-0 rounded-xl bg-white shadow-[6px_6px_12px_#D1D9E6,-6px_-6px_12px_#FFFFFF] flex items-center justify-center disabled:opacity-40">
                    <x-heroicon-o-chevron-right class="w-3 h-3 text-[#717785]" />
                </button>
            </div>
        </div>
        @endif
    </div>

    {{-- Modal: Tambah / Edit Produk --}}
    @if($showModal)
    <template x-teleport="body">
    <div wire:click.self="$set('showModal', false)"
         class="fixed inset-0 bg-black/30 backdrop-blur-sm flex items-center justify-center z-[9999] p-4"
         x-data x-transition.opacity>
        <div class="relative bg-[#F6F9FF] rounded-2xl sm:rounded-[32px] w-full max-w-[672px] p-5 sm:p-8 space-y-5 sm:space-y-7 max-h-[90vh] overflow-y-auto"
             x-transition:enter="transition ease-out duration-200"
             x-transition:enter-start="opacity-0 scale-95"
             x-transition:enter-end="opacity-100 scale-100">

            <button wire:click="$set('showModal', false)"
                    class="absolute right-4 top-4 sm:right-8 sm:top-8 w-9 h-9 sm:w-10 sm:h-10 rounded-full bg-white shadow-[4px_4px_8px_#BABECC,-4px_-4px_8px_#FFFFFF] flex items-center justify-center transition-transform active:scale-95">
                <x-heroicon-o-x-mark class="w-[14px] h-[14px] text-[#40484B]" />
            </button>

            <div>
                <h2 class="text-xl sm:text-3xl font-bold text-[#2681FA] pr-10">{{ $productId ? 'Edit Produk' : 'Tambah Produk Baru' }}</h2>
                <div class="w-16 h-1 bg-[#2681FA] rounded-full mt-2"></div>
            </div>

            <div class="space-y-4 sm:space-y-5">
                {{-- Nama --}}
                <div>
                    <label class="text-[13px] font-semibold tracking-wide text-[#40484B]">Nama Produk</label>
                    <input wire:model="nama" type="text" placeholder="Masukkan nama produk"
                           class="w-full mt-2 bg-[#F6F9FF] shadow-[inset_4px_4px_8px_#BABECC,inset_-4px_-4px_8px_#FFFFFF] rounded-2xl px-5 sm:px-6 py-3.5 sm:py-4 text-sm text-[#181C23] placeholder:text-[#BFC8CB] outline-none">
                    @error('nama') <span class="text-xs text-red-500">{{ $message }}</span> @enderror
                </div>

                {{-- Harga & Stok: stack di mobile, sejajar di desktop --}}
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <label class="text-[13px] font-semibold tracking-wide text-[#40484B]">Harga Produk</label>
                        <div class="relative mt-2"
                             x-data="{ display: '{{ $harga ? number_format($harga, 0, ',', '.') : '' }}' }">
                            <span class="absolute left-5 sm:left-6 top-1/2 -translate-y-1/2 text-sm text-[#8A93A6] pointer-events-none">Rp</span>
                            <input type="text" inputmode="numeric" placeholder="0"
                                   x-model="display"
                                   x-on:input="
                                       let raw = display.replace(/\D/g, '');
                                       display = raw ? new Intl.NumberFormat('id-ID').format(raw) : '';
                                       $wire.set('harga', raw);
                                   "
                                   class="w-full bg-[#F6F9FF] shadow-[inset_4px_4px_8px_#BABECC,inset_-4px_-4px_8px_#FFFFFF] rounded-2xl pl-11 pr-5 sm:pr-6 py-3.5 sm:py-4 text-sm text-[#181C23] placeholder:text-[#BFC8CB] outline-none">
                        </div>
                        @error('harga') <span class="text-xs text-red-500">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <label class="text-[13px] font-semibold tracking-wide text-[#40484B]">Stok</label>
                        <input wire:model="stok" type="number" min="0" placeholder="0"
                               class="w-full mt-2 bg-[#F6F9FF] shadow-[inset_4px_4px_8px_#BABECC,inset_-4px_-4px_8px_#FFFFFF] rounded-2xl px-5 sm:px-6 py-3.5 sm:py-4 text-sm text-[#181C23] outline-none">
                        @error('stok') <span class="text-xs text-red-500">{{ $message }}</span> @enderror
                    </div>
                </div>

                {{-- Deskripsi --}}
                <div>
                    <label class="text-[13px] font-semibold tracking-wide text-[#40484B]">Deskripsi Produk</label>
                    <textarea wire:model="deskripsi" rows="4" placeholder="Tuliskan penjelasan produk di sini..."
                              class="w-full mt-2 bg-[#F6F9FF] shadow-[inset_4px_4px_8px_#BABECC,inset_-4px_-4px_8px_#FFFFFF] rounded-2xl px-5 sm:px-6 py-3.5 sm:py-4 text-sm text-[#181C23] placeholder:text-[#BFC8CB] outline-none resize-none"></textarea>
                </div>

                {{-- Foto Produk: multi upload --}}
                <div>
                    <label class="text-[13px] font-semibold tracking-wide text-[#40484B]">Foto Produk</label>
                    <p class="text-xs text-[#8A93A6] mt-1">Bisa unggah beberapa foto sekaligus. Foto pertama otomatis jadi foto utama.</p>

                    <div class="grid grid-cols-3 sm:grid-cols-4 gap-2.5 sm:gap-3 mt-3">
                        {{-- Foto tersimpan (saat edit) --}}
                        @foreach($existingImages as $image)
                        <div class="relative group aspect-square" wire:key="existing-{{ $image->id }}">
                            <img src="{{ Storage::url($image->path) }}"
                                 class="w-full h-full object-cover rounded-xl shadow-[inset_2px_2px_4px_#BABECC]">
                            <button type="button" wire:click="removeExistingImage({{ $image->id }})"
                                    class="absolute -top-2 -right-2 w-6 h-6 rounded-full bg-white shadow-[2px_2px_6px_#BABECC] flex items-center justify-center opacity-100 sm:opacity-0 sm:group-hover:opacity-100 transition">
                                <x-heroicon-o-x-mark class="w-3 h-3 text-red-500" />
                            </button>
                        </div>
                        @endforeach

                        {{-- Preview foto baru yang sedang dipilih --}}
                        @foreach($gambar as $index => $file)
                        <div class="relative aspect-square" wire:key="new-{{ $index }}">
                            <img src="{{ $file->temporaryUrl() }}" class="w-full h-full object-cover rounded-xl shadow-[inset_2px_2px_4px_#BABECC]">
                        </div>
                        @endforeach

                        {{-- Tombol tambah foto --}}
                        <label for="gambar-upload"
                               class="aspect-square flex flex-col items-center justify-center gap-1 bg-[#F6F9FF] shadow-[inset_4px_4px_8px_#BABECC,inset_-4px_-4px_8px_#FFFFFF] rounded-xl border-2 border-dashed border-[#BFC8CB]/40 cursor-pointer">
                            <x-heroicon-o-arrow-up-tray class="w-5 h-5 text-[#4CC71C]" />
                            <span class="text-[10px] sm:text-[11px] font-semibold text-[#40484B] text-center px-1">Tambah Foto</span>
                            <input id="gambar-upload" wire:model="gambar" type="file" accept="image/*" multiple class="hidden">
                        </label>
                    </div>
                    @error('gambar.*') <span class="text-xs text-red-500 block mt-2">{{ $message }}</span> @enderror
                </div>
            </div>

            <div class="flex flex-col sm:flex-row justify-end gap-3 sm:gap-4 pt-2">
                <button wire:click="$set('showModal', false)"
                        class="bg-white shadow-[6px_6px_12px_#BABECC,-6px_-6px_12px_#FFFFFF] rounded-2xl px-6 sm:px-10 py-3.5 sm:py-4 text-[#4CC71C] font-bold transition-transform active:scale-95">
                    Batal
                </button>
                <button wire:click="save"
                        class="flex items-center justify-center gap-2 bg-[#4CC71C] shadow-[6px_6px_12px_#BABECC,-6px_-6px_12px_#FFFFFF] rounded-2xl px-6 sm:px-10 py-3.5 sm:py-4 text-white font-bold transition-transform active:scale-95">
                    <x-heroicon-o-check class="w-[14px] h-[14px]" />
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
    <div wire:click.self="$set('showDeleteModal', false)"
         class="fixed inset-0 bg-black/40 backdrop-blur-sm flex items-center justify-center z-[9999] p-4"
         x-data x-transition.opacity>
        <div class="bg-[#F6F9FF] rounded-2xl sm:rounded-[32px] w-full max-w-[420px] p-5 sm:p-10 text-center space-y-5 sm:space-y-6"
             x-transition:enter="transition ease-out duration-200"
             x-transition:enter-start="opacity-0 scale-95"
             x-transition:enter-end="opacity-100 scale-100">
            <div class="w-14 h-14 sm:w-16 sm:h-16 rounded-full bg-red-50 flex items-center justify-center mx-auto">
                <x-heroicon-o-exclamation-triangle class="w-6 h-6 sm:w-7 sm:h-7 text-[#FF383C]" />
            </div>
            <div class="space-y-2">
                <p class="text-[#181C23] text-lg sm:text-xl font-bold">Hapus Produk Ini?</p>
                <p class="text-[#717785] text-sm leading-relaxed break-words">
                    Produk <span class="font-bold text-[#181C23]">"{{ $deleteNama }}"</span> akan dihapus permanen dan tidak dapat dikembalikan.
                </p>
            </div>
            <div class="flex gap-3 sm:gap-4 pt-2">
                <button wire:click="$set('showDeleteModal', false)"
                        class="flex-1 bg-white shadow-[6px_6px_12px_#D1D9E6,-6px_-6px_12px_#FFFFFF] rounded-2xl px-4 sm:px-6 py-3 sm:py-3.5 text-[#414754] font-semibold text-sm transition-transform active:scale-95">
                    Batal
                </button>
                <button wire:click="delete"
                        class="flex-1 flex items-center justify-center gap-2 bg-[#FF383C] rounded-2xl px-4 sm:px-6 py-3 sm:py-3.5 text-white font-semibold text-sm transition-transform active:scale-95">
                    <x-heroicon-o-trash class="w-4 h-4" />
                    Ya, Hapus
                </button>
            </div>
        </div>
    </div>
    </template>
    @endif
</div>