<div class="space-y-6 sm:space-y-8 max-w-6xl">
    @include('partials.admin-flash-messages')

    {{-- Header --}}
    <div>
<<<<<<< HEAD
        <h1 class="text-xl sm:text-2xl lg:text-3xl font-bold text-[#2681FA]">Kelola Artikel & Berita</h1>
        <p class="text-sm sm:text-base text-[#414754] mt-1">Tulis dan publikasikan artikel maupun berita acara yang tampil di halaman publik.</p>
    </div>

    {{-- Stat Cards --}}
    <div class="grid grid-cols-2 gap-3 sm:gap-6 max-w-xl">
        <x-ui.stat-card
            label="Total Artikel"
            :value="$totalArticles ?? $articles->total()"
            icon="document-text" />
        <x-ui.stat-card
            label="Total Artikel Gagal"
            :value="$totalFailedArticles ?? 0"
            icon="clipboard-document-list"
            iconColor="text-red-500" />
    </div>

    {{-- Table Card --}}
    <div class="bg-[#F9F9FF] rounded-2xl sm:rounded-[32px] shadow-[6px_6px_12px_#D1D9E6,-6px_-6px_12px_#FFFFFF] overflow-hidden">

        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 px-4 sm:px-8 py-5 sm:py-8 border-b border-[#E0E2EC]/30">
            <h2 class="text-lg sm:text-2xl font-semibold text-[#2681FA]">Daftar Artikel & Berita</h2>
            <div class="flex flex-col sm:flex-row items-stretch sm:items-center gap-3 sm:gap-4">
                <div class="relative w-full sm:w-56">
                    <x-heroicon-o-magnifying-glass class="w-[18px] h-[18px] text-[#717785] absolute left-4 top-1/2 -translate-y-1/2 pointer-events-none" />
                    <input wire:model.live.debounce.300ms="search" type="text" placeholder="Cari judul..."
                           class="w-full bg-white shadow-[inset_4px_4px_8px_#D1D9E6,inset_-4px_-4px_8px_#FFFFFF] rounded-xl pl-11 pr-4 py-2.5 text-sm text-[#181C23] placeholder:text-[#6B7280] outline-none">
=======
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
>>>>>>> 7c2b0c38c7cbb0458913dc97ac2a87842c5a8228
                </div>
                <button wire:click="create"
                        class="flex items-center justify-center gap-2 bg-[#4CC71C] shadow-[6px_6px_12px_#D1D9E6,-6px_-6px_12px_#FFFFFF] rounded-xl px-5 py-2.5 text-sm text-white font-medium whitespace-nowrap transition-transform active:scale-95">
                    <x-heroicon-o-plus class="w-5 h-5" />
                    Tambah Artikel
                </button>
            </div>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full min-w-[760px] text-sm table-fixed">
                <colgroup>
                    <col class="w-[34%]">
                    <col class="w-[16%]">
                    <col class="w-[16%]">
                    <col class="w-[14%]">
                    <col class="w-[120px]">
                </colgroup>
                <thead>
                    <tr class="text-left text-[#717785] border-b border-[#E0E2EC]/30">
                        <th class="py-4 px-4 sm:px-8 font-bold text-base whitespace-nowrap">Judul Artikel</th>
                        <th class="py-4 px-2 font-bold text-base whitespace-nowrap">Kategori</th>
                        <th class="py-4 px-2 font-bold text-base whitespace-nowrap">Tanggal Terbit</th>
                        <th class="py-4 px-2 font-bold text-base whitespace-nowrap">Status</th>
                        <th class="py-4 pr-4 sm:pr-8 font-bold text-base text-center whitespace-nowrap">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($articles as $article)
                    <tr class="border-b border-[#E0E2EC]/30 last:border-0">
                        <td class="py-5 px-4 sm:px-8">
                            <div class="flex items-center gap-3 min-w-0">
                                @if($article->thumbnail)
                                <img src="{{ Storage::url($article->thumbnail) }}" class="w-12 h-12 rounded-xl object-cover shadow-sm shrink-0">
                                @else
                                <div class="w-12 h-12 rounded-xl bg-[#e5e7eab5] flex items-center justify-center shrink-0">
                                    <x-heroicon-o-photo class="w-5 h-5 text-gray-400" />
                                </div>
                                @endif
                                <p class="font-bold text-[#181C23] leading-snug truncate">{{ $article->title }}</p>
                            </div>
                        </td>
                        <td class="py-5 px-2">
                            <span class="inline-block px-3 py-1 rounded-full text-xs font-semibold
                                {{ $article->category === 'produk' ? 'bg-green-100 text-green-600' : 'bg-blue-100 text-blue-600' }}">
                                {{ $article->category === 'produk' ? 'Artikel Berita' : 'Berita Acara' }}
                            </span>
                        </td>
                        <td class="py-5 px-2 text-[#414754] truncate">{{ $article->published_at?->translatedFormat('d M Y') ?? '-' }}</td>
                        <td class="py-5 px-2">
                            @isset($article->status)
                            <span class="inline-flex items-center gap-1.5 text-xs font-medium
                                {{ $article->status === 'sukses' ? 'text-green-600' : 'text-red-500' }}">
                                <span class="w-1.5 h-1.5 rounded-full {{ $article->status === 'sukses' ? 'bg-green-500' : 'bg-red-500' }}"></span>
                                {{ $article->status === 'sukses' ? 'Sukses' : 'Gagal' }}
                            </span>
                            @else
                            <span class="text-xs text-gray-300">-</span>
                            @endisset
                        </td>
                        <td class="pr-4 sm:pr-8 py-5">
                            <div class="flex items-center justify-center gap-2">
                                <button wire:click="edit({{ $article->id }})"
                                        class="w-9 h-9 shrink-0 rounded-lg bg-white shadow-[6px_6px_12px_#D1D9E6,-6px_-6px_12px_#FFFFFF] flex items-center justify-center transition-transform active:scale-95">
                                    <x-heroicon-o-pencil-square class="w-[18px] h-[18px] text-[#4CC71C]" />
                                </button>
                                <button wire:click="confirmDelete({{ $article->id }})"
                                        class="w-9 h-9 shrink-0 rounded-lg bg-white shadow-[6px_6px_12px_#D1D9E6,-6px_-6px_12px_#FFFFFF] flex items-center justify-center transition-transform active:scale-95">
                                    <x-heroicon-o-trash class="w-[18px] h-[18px] text-[#FF383C]" />
                                </button>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5">
                            <x-ui.table-empty-state
                                icon="document-text"
                                title="Belum Ada Artikel"
                                message="Tambahkan artikel atau berita pertama untuk ditampilkan di halaman publik.">
                            </x-ui.table-empty-state>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- Pagination --}}
        @if($articles->total() > 0)
        @php
            $current = $articles->currentPage();
            $last = $articles->lastPage();
            $window = [];
            for ($i = max(1, $current - 1); $i <= min($last, $current + 1); $i++) { $window[] = $i; }
        @endphp
        <div class="flex flex-col sm:flex-row items-center justify-between gap-4 px-4 sm:px-8 py-5 sm:py-8 border-t border-[#E0E2EC]/30">
            <p class="text-xs sm:text-base text-[#717785] text-center sm:text-left">
                Menampilkan {{ $articles->count() }} dari {{ $articles->total() }} Artikel
            </p>

            <div class="flex sm:hidden items-center gap-2 overflow-x-auto max-w-full py-1">
                <button wire:click="previousPage" @if($articles->onFirstPage()) disabled @endif
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
                <button wire:click="nextPage" @if($articles->onLastPage()) disabled @endif
                        class="w-9 h-9 shrink-0 rounded-xl bg-white shadow-[6px_6px_12px_#D1D9E6,-6px_-6px_12px_#FFFFFF] flex items-center justify-center disabled:opacity-40">
                    <x-heroicon-o-chevron-right class="w-3 h-3 text-[#717785]" />
                </button>
            </div>

<<<<<<< HEAD
            <div class="hidden sm:flex items-center gap-2 flex-wrap justify-center">
                <button wire:click="previousPage" @if($articles->onFirstPage()) disabled @endif
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
                <button wire:click="nextPage" @if($articles->onLastPage()) disabled @endif
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
        <div class="relative bg-[#F6F9FF] rounded-2xl sm:rounded-[32px] w-full max-w-[672px] max-h-[90vh] overflow-y-auto p-5 sm:p-8 space-y-5 sm:space-y-8">

            <button wire:click="$set('showModal', false)"
                    class="absolute right-4 top-4 sm:right-8 sm:top-8 w-9 h-9 sm:w-10 sm:h-10 rounded-full bg-white shadow-[4px_4px_8px_#BABECC,-4px_-4px_8px_#FFFFFF] flex items-center justify-center transition-transform active:scale-95">
                <x-heroicon-o-x-mark class="w-[14px] h-[14px] text-[#40484B]" />
            </button>

            <div>
                <h2 class="text-xl sm:text-3xl font-bold text-[#2681FA] pr-10">{{ $articleId ? 'Edit Artikel' : 'Tambah Artikel' }}</h2>
                <div class="w-16 h-1 bg-[#2681FA] rounded-full mt-2"></div>
            </div>

            <div class="space-y-5 sm:space-y-6">
                <div>
                    <label class="text-[13px] font-semibold tracking-wide text-[#40484B]">Judul</label>
                    <input wire:model="title" type="text" placeholder="Masukkan judul artikel"
                           class="w-full mt-2 bg-[#F6F9FF] shadow-[inset_4px_4px_8px_#BABECC,inset_-4px_-4px_8px_#FFFFFF] rounded-2xl px-5 sm:px-6 py-3.5 sm:py-4 text-sm text-[#181C23] placeholder:text-[#BFC8CB] outline-none">
                    @error('title') <span class="text-xs text-red-500">{{ $message }}</span> @enderror
                </div>

                <div>
                    <label class="text-[13px] font-semibold tracking-wide text-[#40484B]">Konten</label>
                    <textarea wire:model="content" rows="5" placeholder="Tuliskan isi artikel..."
                              class="w-full mt-2 bg-[#F6F9FF] shadow-[inset_4px_4px_8px_#BABECC,inset_-4px_-4px_8px_#FFFFFF] rounded-2xl px-5 sm:px-6 py-3.5 sm:py-4 text-sm text-[#181C23] placeholder:text-[#BFC8CB] outline-none resize-none"></textarea>
                    @error('content') <span class="text-xs text-red-500">{{ $message }}</span> @enderror
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <label class="text-[13px] font-semibold tracking-wide text-[#40484B]">Kategori</label>
                        <select wire:model="category"
                                class="w-full mt-2 bg-[#F6F9FF] shadow-[inset_4px_4px_8px_#BABECC,inset_-4px_-4px_8px_#FFFFFF] rounded-2xl px-5 sm:px-6 py-3.5 sm:py-4 text-sm text-[#181C23] outline-none appearance-none">
                            <option value="produk">Artikel Berita</option>
                            <option value="berita_acara">Berita Acara</option>
                        </select>
                    </div>
                    <div>
                        <label class="text-[13px] font-semibold tracking-wide text-[#40484B]">Tanggal Terbit</label>
                        <input wire:model="published_at" type="date"
                               class="w-full mt-2 bg-[#F6F9FF] shadow-[inset_4px_4px_8px_#BABECC,inset_-4px_-4px_8px_#FFFFFF] rounded-2xl px-5 sm:px-6 py-3.5 sm:py-4 text-sm text-[#181C23] outline-none">
                    </div>
                </div>

                <div>
                    <label class="text-[13px] font-semibold tracking-wide text-[#40484B]">Thumbnail</label>
                    <input wire:model="thumbnail" type="file" accept="image/*" class="w-full mt-2 text-sm">
                    <p class="text-xs text-[#94A3B8] mt-1">Format JPG/PNG/WebP, maksimal 10MB.</p>
                    @error('thumbnail') <span class="text-xs text-red-500">{{ $message }}</span> @enderror

                    @if($thumbnail)
                    <img src="{{ $thumbnail->temporaryUrl() }}" class="w-20 h-20 rounded-xl object-cover mt-3 shadow-[inset_2px_2px_4px_#BABECC]">
                    @elseif($existingThumbnail)
                    <img src="{{ Storage::url($existingThumbnail) }}" class="w-20 h-20 rounded-xl object-cover mt-3 shadow-[inset_2px_2px_4px_#BABECC]">
                    @endif
                </div>

                <div>
                    <label class="text-[13px] font-semibold tracking-wide text-[#40484B]">Galeri Gambar (bisa lebih dari 1)</label>
                    <input wire:model="galleryImages" type="file" multiple accept="image/*" class="w-full mt-2 text-sm">
                    <p class="text-xs text-[#94A3B8] mt-1">Format JPG/PNG/WebP, maksimal 10MB per gambar.</p>
                    @error('galleryImages.*') <span class="text-xs text-red-500">{{ $message }}</span> @enderror

                    <div class="grid grid-cols-3 sm:grid-cols-4 gap-2.5 sm:gap-3 mt-3">
                        @foreach($existingGallery as $index => $path)
                        <div class="relative aspect-square" wire:key="existing-{{ $index }}">
                            <img src="{{ Storage::url($path) }}" class="w-full h-full rounded-xl object-cover shadow-[inset_2px_2px_4px_#BABECC]">
                            <button type="button" wire:click="removeExistingGalleryImage({{ $index }})"
                                    class="absolute -top-2 -right-2 w-6 h-6 rounded-full bg-white shadow-[2px_2px_6px_#BABECC] flex items-center justify-center">
                                <x-heroicon-o-x-mark class="w-3 h-3 text-red-500" />
                            </button>
                        </div>
                        @endforeach
                        @foreach($galleryImages as $index => $image)
                        <div class="aspect-square" wire:key="new-{{ $index }}">
                            <img src="{{ $image->temporaryUrl() }}" class="w-full h-full rounded-xl object-cover shadow-[inset_2px_2px_4px_#BABECC]">
                        </div>
                        @endforeach
                    </div>
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
>>>>>>> 7c2b0c38c7cbb0458913dc97ac2a87842c5a8228
            </div>
        </div>
    </div>
    </template>
    @endif

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
                <p class="text-[#181C23] text-lg sm:text-xl font-bold">Hapus Artikel Ini?</p>
                <p class="text-[#717785] text-sm leading-relaxed">Artikel ini akan dihapus permanen dan tidak dapat dikembalikan.</p>
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
            </div>
        </div>
    </div>
    </template>
    @endif
</div>
