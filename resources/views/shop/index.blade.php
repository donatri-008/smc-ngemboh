@extends('layouts.app')
@section('title', 'Belanja - Smart Maritim Community Ngemboh')

@section('content')
<div class="bg-blue-50/60 min-h-screen">
    <div class="max-w-4xl mx-auto px-6 pt-10 sm:pt-16 pb-10 text-center space-y-3 sm:space-y-4">
        <h1 class="text-3xl sm:text-4xl md:text-5xl font-bold text-blue-700 tracking-tight">Katalog Produk</h1>
        <p class="text-[#454545] text-sm sm:text-base">Cari tahu terkait produk unggulan Desa Ngemboh</p>
    </div>

    <div class="max-w-6xl mx-auto px-4 sm:px-6 pb-16 sm:pb-20 space-y-8 sm:space-y-10">
        <div class="grid grid-cols-2 lg:grid-cols-4 gap-4 sm:gap-6 items-stretch">
@forelse($products as $product)
<div class="flex flex-col h-full p-2.5 sm:p-3 gap-2.5 sm:gap-3 rounded-2xl sm:rounded-[24px] bg-[#F6F9FF] transition-shadow hover:shadow-lg"
     style="box-shadow: 6px 6px 12px #BABECC;">

    {{-- Image --}}
    <a href="{{ route('shop.show', $product) }}" class="block relative rounded-xl sm:rounded-2xl overflow-hidden aspect-[4/3] bg-white">
        @if($product->gambar)
        <img src="{{ Storage::url($product->gambar) }}"
             alt="{{ $product->nama }}"
             class="w-full h-full object-cover">
        @else
        <div class="w-full h-full flex items-center justify-center">
            <x-heroicon-o-photo class="w-8 h-8 text-gray-300" />
        </div>
        @endif

        @if($product->stok <= 5 && $product->stok > 0)
        <span class="absolute top-2 right-2 text-[10px] font-medium px-2 py-1 rounded-full bg-red-500/90 text-white">
            Stok {{ $product->stok }}
        </span>
        @elseif($product->stok == 0)
        <span class="absolute top-2 right-2 text-[10px] font-medium px-2 py-1 rounded-full bg-gray-500/90 text-white">
            Habis
        </span>
        @endif
    </a>

    {{-- Text content --}}
    <div class="flex flex-col flex-1 px-1 gap-1">
        <a href="{{ route('shop.show', $product) }}"
           class="block text-sm sm:text-base font-medium text-[#171C21] leading-5 sm:leading-6 line-clamp-1 hover:text-[#2681FA] transition">
            {{ $product->nama }}
        </a>
        <p class="text-xs sm:text-sm text-[#40484B] leading-5 line-clamp-2 min-h-[2.25rem] sm:min-h-[2.5rem]">
            {{ $product->deskripsi ?: 'Belum ada deskripsi.' }}
        </p>

        {{-- Price + Add button — selalu menempel di bawah card --}}
        <div class="flex items-center justify-between pt-2 sm:pt-3 mt-auto gap-2">
            <p class="text-sm sm:text-base font-semibold text-[#2681FA] leading-6 whitespace-nowrap truncate">
                Rp {{ number_format($product->harga, 0, ',', '.') }}
            </p>

            @if($product->stok > 0)
            <form
                x-data="{ loading: false }"
                x-on:submit.prevent="
                    const tokenEl = document.querySelector('meta[name=csrf-token]');
                    if (! tokenEl) {
                        window.showToast('error', 'CSRF token tidak ditemukan. Muat ulang halaman.');
                        return;
                    }
                    loading = true;
                    fetch($el.action, {
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': tokenEl.content,
                            'Accept': 'application/json',
                        },
                        body: new FormData($el),
                    })
                    .then(res => res.json())
                    .then(data => {
                        loading = false;
                        window.showToast(data.success ? 'success' : 'error', data.message);
                        if (data.success) {
                            window.dispatchEvent(new CustomEvent('cart-updated', { detail: { count: data.cart_count } }));
                        }
                    })
                    .catch(() => {
                        loading = false;
                        window.showToast('error', 'Gagal menambahkan produk ke keranjang.');
                    });
                "
                action="{{ route('cart.add', $product) }}" method="POST" class="shrink-0">
                @csrf
                <button type="submit" :disabled="loading"
                        class="w-9 h-9 sm:w-11 sm:h-11 shrink-0 rounded-full bg-[#4CC71C] flex items-center justify-center hover:bg-[#3DA617] transition disabled:opacity-60"
                        style="box-shadow: -6px -6px 12px #FFFFFF, 6px 6px 12px #BABECC;">
                    <x-heroicon-o-plus class="w-3.5 h-3.5 sm:w-4 sm:h-4 text-white" x-show="!loading" />
                    <svg x-show="loading" x-cloak class="w-3.5 h-3.5 sm:w-4 sm:h-4 text-white animate-spin" fill="none" viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4z"></path>
                    </svg>
                </button>
            </form>
            @else
            <span class="w-9 h-9 sm:w-11 sm:h-11 shrink-0 rounded-full bg-gray-200 flex items-center justify-center cursor-not-allowed">
                <x-heroicon-o-x-mark class="w-3.5 h-3.5 sm:w-4 sm:h-4 text-gray-400" />
            </span>
            @endif
        </div>
    </div>
</div>
@empty
<div class="col-span-full">
    <x-ui.empty-state
        icon="shopping-bag"
        title="Belum Ada Produk"
        message="Produk unggulan dari komunitas akan segera hadir." />
</div>
@endforelse
        </div>

        {{-- Pagination --}}
        @if($products->hasPages())
        <div class="flex justify-center">
            <div class="flex items-center gap-2 sm:gap-4 overflow-x-auto max-w-full px-2 py-1">
                @if($products->onFirstPage())
                <span class="w-8 h-8 sm:w-10 sm:h-10 shrink-0 rounded-full flex items-center justify-center opacity-40"
                      style="box-shadow: -3px -3px 6px #FFFFFF, 3px 3px 6px #BABECC;">
                    <x-heroicon-o-chevron-left class="w-3 h-3 text-[#4CC71C]" />
                </span>
                @else
                <a href="{{ $products->previousPageUrl() }}"
                   class="w-8 h-8 sm:w-10 sm:h-10 shrink-0 rounded-full flex items-center justify-center"
                   style="box-shadow: -3px -3px 6px #FFFFFF, 3px 3px 6px #BABECC;">
                    <x-heroicon-o-chevron-left class="w-3 h-3 text-[#4CC71C]" />
                </a>
                @endif

                <div class="flex items-center gap-1.5 sm:gap-2 shrink-0">
                    @for ($i = 1; $i <= $products->lastPage(); $i++)
                    @if($products->currentPage() == $i)
                    <a href="{{ $products->url($i) }}"
                       class="w-8 h-8 sm:w-10 sm:h-10 shrink-0 rounded-full flex items-center justify-center text-sm sm:text-base text-white bg-[#4CC71C]"
                       style="box-shadow: -3px -3px 6px #FFFFFF, 3px 3px 6px #BABECC;">
                        {{ $i }}
                    </a>
                    @else
                    <a href="{{ $products->url($i) }}"
                       class="w-8 h-8 sm:w-10 sm:h-10 shrink-0 rounded-full flex items-center justify-center text-sm sm:text-base text-[#40484B]">
                        {{ $i }}
                    </a>
                    @endif
                    @endfor
                </div>

                @if($products->hasMorePages())
                <a href="{{ $products->nextPageUrl() }}"
                   class="w-8 h-8 sm:w-10 sm:h-10 shrink-0 rounded-full flex items-center justify-center"
                   style="box-shadow: -3px -3px 6px #FFFFFF, 3px 3px 6px #BABECC;">
                    <x-heroicon-o-chevron-right class="w-3 h-3 text-[#4CC71C]" />
                </a>
                @else
                <span class="w-8 h-8 sm:w-10 sm:h-10 shrink-0 rounded-full flex items-center justify-center opacity-40"
                      style="box-shadow: -3px -3px 6px #FFFFFF, 3px 3px 6px #BABECC;">
                    <x-heroicon-o-chevron-right class="w-3 h-3 text-[#4CC71C]" />
                </span>
                @endif
            </div>
        </div>
        @endif
    </div>
</div>
@endsection