@extends('layouts.app')
@section('title', $product->nama)

@php
    $metaTitle = $product->nama . ' - Belanja SMC Ngemboh';
    $metaDescription = Str::limit(strip_tags($product->deskripsi), 155);
    $metaImage = $product->gambar ? Storage::url($product->gambar) : null;
    $galleryImages = $product->images->count() > 0
        ? $product->images->pluck('path')->map(fn ($p) => Storage::url($p))->values()->toArray()
        : ($product->gambar ? [Storage::url($product->gambar)] : []);
@endphp

@section('content')
<div class="bg-section-blue min-h-screen">
    <div class="max-w-6xl mx-auto px-4 sm:px-6 pt-6 sm:pt-10 pb-16 sm:pb-20 space-y-4">

        <a href="{{ route('shop.index') }}" class="inline-flex w-9 h-9 sm:w-11 sm:h-11 rounded-full bg-[#4CC71C] items-center justify-center hover:bg-[#3DA617] transition">
            <x-heroicon-o-arrow-left class="w-4 h-4 sm:w-5 sm:h-5 text-white" />
        </a>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-8 sm:gap-10 pt-4">
            {{-- Gallery --}}
            <div class="space-y-3 sm:space-y-4" x-data='{
                    images: @json($galleryImages),
                    current: 0,
                    next() { this.current = (this.current + 1) % this.images.length; },
                    prev() { this.current = (this.current - 1 + this.images.length) % this.images.length; }
                 }'>
                <div class="relative bg-white rounded-2xl sm:rounded-3xl shadow-sm p-3 sm:p-4 h-[260px] sm:h-[340px] md:h-[380px] lg:h-[420px] flex items-center justify-center overflow-hidden">
                    <template x-if="images.length > 0">
                        <img :src="images[current]" class="w-full h-full object-contain rounded-2xl">
                    </template>
                    <template x-if="images.length === 0">
                        <div class="w-full h-full bg-gray-100 rounded-2xl"></div>
                    </template>

                    {{-- Panah kiri/kanan cuma muncul kalau foto lebih dari 1 --}}
                    <template x-if="images.length > 1">
                        <button type="button" @click="prev()" aria-label="previous image"
                                class="absolute left-2 sm:left-4 top-1/2 -translate-y-1/2 w-8 h-8 sm:w-10 sm:h-10 rounded-full bg-white/90 shadow-md flex items-center justify-center hover:bg-white transition">
                            <x-heroicon-o-chevron-left class="w-4 h-4 sm:w-5 sm:h-5 text-gray-700" />
                        </button>
                    </template>
                    <template x-if="images.length > 1">
                        <button type="button" @click="next()" aria-label="next image"
                                class="absolute right-2 sm:right-4 top-1/2 -translate-y-1/2 w-8 h-8 sm:w-10 sm:h-10 rounded-full bg-white/90 shadow-md flex items-center justify-center hover:bg-white transition">
                            <x-heroicon-o-chevron-right class="w-4 h-4 sm:w-5 sm:h-5 text-gray-700" />
                        </button>
                    </template>
                </div>

                {{-- Thumbnail juga cuma muncul kalau foto lebih dari 1 --}}
                <template x-if="images.length > 1">
                    <div class="grid grid-cols-4 gap-2 sm:gap-3">
                        <template x-for="(img, index) in images" :key="index">
                            <button type="button" @click="current = index" aria-label="thumbnail"
                                    class="bg-white rounded-lg sm:rounded-xl p-1 shadow-sm ring-2 transition"
                                    :class="current === index ? 'ring-[#4CC71C]' : 'ring-transparent'">
                                <img :src="img" class="w-full h-14 sm:h-20 object-cover rounded-lg">
                            </button>
                        </template>
                    </div>
                </template>
            </div>

            {{-- Info --}}
            <div class="space-y-5 sm:space-y-6" x-data="{ qty: 1, stok: {{ $product->stok }}, loading: false }">
                <div>
                    <h1 class="text-2xl sm:text-3xl md:text-4xl font-bold text-gray-900">{{ $product->nama }}</h1>
                    <p class="text-xl sm:text-2xl md:text-3xl font-bold text-blue-500 mt-2">Rp {{ number_format($product->harga, 0, ',', '.') }}</p>
                </div>

                <div class="bg-white rounded-2xl p-4 sm:p-6 space-y-4">
                    <p class="text-sm sm:text-base text-gray-600 leading-relaxed">{{ $product->deskripsi }}</p>
                    <div class="flex items-center gap-2 text-blue-500 font-semibold text-xs sm:text-sm">
                        <x-heroicon-o-cube class="w-4 h-4" />
                        Stok tersedia: {{ $product->stok }} buah
                    </div>
                </div>

                @if($product->stok > 0)
                <form
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
                    action="{{ route('cart.add', $product) }}" method="POST" class="space-y-4">
                    @csrf
                    <div class="flex flex-wrap items-center gap-3 sm:gap-6">
                        <span class="font-semibold text-base sm:text-lg text-gray-900">Jumlah</span>
                        <div class="flex items-center gap-3 sm:gap-4">
                            <button type="button" @click="qty = Math.max(1, qty - 1)" aria-label="decrease quantity"
                                    class="w-9 h-9 sm:w-10 sm:h-10 rounded-full bg-[#4CC71C] shadow-[-6px_-6px_12px_#FFFFFF,6px_6px_12px_#BABECC] flex items-center justify-center text-white">
                                <span class="text-lg leading-none">−</span>
                            </button>
                            <span class="w-8 text-center text-base sm:text-lg font-semibold text-gray-900" x-text="qty"></span>
                            <button type="button" @click="qty = Math.min(stok, qty + 1)" aria-label="increase quantity"
                                    class="w-9 h-9 sm:w-10 sm:h-10 rounded-full bg-[#4CC71C] shadow-[-6px_-6px_12px_#FFFFFF,6px_6px_12px_#BABECC] flex items-center justify-center text-white">
                                <x-heroicon-o-plus class="w-3.5 h-3.5" />
                            </button>
                        </div>
                    </div>
                    <input type="hidden" name="qty" x-bind:value="qty">
                    <button type="submit" :disabled="loading" aria-label="loading"
                            class="w-full flex items-center justify-center gap-3 bg-[#4CC71C] hover:bg-[#3DA617] transition rounded-2xl sm:rounded-3xl py-3.5 sm:py-4 text-white font-semibold text-base sm:text-lg shadow-md disabled:opacity-60">
                        <x-heroicon-o-shopping-cart class="w-5 h-5" x-show="!loading" />
                        <svg x-show="loading" x-cloak class="w-5 h-5 animate-spin" fill="none" viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4z"></path>
                        </svg>
                        <span x-text="loading ? 'Memproses...' : 'Tambah ke Keranjang'"></span>
                    </button>
                </form>
                @else
                <p class="text-red-500 font-semibold">Stok habis</p>
                @endif
            </div>
        </div>

        {{-- Produk Lainnya --}}
        @php
            $related = \App\Models\Product::where('id', '!=', $product->id)->latest()->take(4)->get();
        @endphp
        <section class="pt-12 sm:pt-16 space-y-5 sm:space-y-6">
            <div class="flex flex-col sm:flex-row sm:items-end sm:justify-between gap-3">
                <div>
                    <h2 class="text-2xl sm:text-3xl font-bold text-blue-500">Produk Lainnya</h2>
                    <p class="text-sm sm:text-base text-gray-500 mt-1">Temukan kerajinan dan hasil laut unggulan warga Ngemboh</p>
                </div>
                <a href="{{ route('shop.index') }}" class="inline-flex items-center gap-1 text-[#4CC71C] font-semibold hover:underline whitespace-nowrap text-sm sm:text-base">
                    Lihat Semua <x-heroicon-o-arrow-right class="w-4 h-4" />
                </a>
            </div>

            <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 gap-4 sm:gap-6">
                @foreach($related as $item)
                <a href="{{ route('shop.show', $item) }}" class="bg-white rounded-2xl sm:rounded-3xl shadow-sm p-3 sm:p-4 space-y-2 block hover:shadow-md transition">
                    @if($item->gambar)
                    <img src="{{ Storage::url($item->gambar) }}" class="w-full h-28 sm:h-40 rounded-xl sm:rounded-2xl object-cover">
                    @else
                    <div class="w-full h-28 sm:h-40 rounded-xl sm:rounded-2xl bg-gray-100"></div>
                    @endif
                    <p class="text-sm sm:text-base text-gray-900 font-medium truncate">{{ $item->nama }}</p>
                    <p class="text-sm sm:text-base text-blue-500 font-semibold">Rp {{ number_format($item->harga, 0, ',', '.') }}</p>
                </a>
                @endforeach
            </div>
        </section>
    </div>
</div>
@endsection