@extends('layouts.app')
@section('title', 'Keranjang - Smart Maritim Community Ngemboh')

@php
    $cartItems = collect($cart)->map(function ($item, $id) {
        return [
            'id'     => $id,
            'nama'   => $item['nama'],
            'harga'  => (float) $item['harga'],
            'qty'    => (int) $item['qty'],
            'gambar' => !empty($item['gambar']) ? Storage::url($item['gambar']) : null,
        ];
    })->values();

    $updateUrlTemplate = route('cart.update', ['product' => '__ID__']);
    $removeUrlTemplate = route('cart.remove', ['product' => '__ID__']);
@endphp

@section('content')
<div
    class="max-w-6xl mx-auto px-3 sm:px-6 lg:px-8 pt-6 sm:pt-10 pb-16 space-y-6 sm:space-y-8"
    x-data="{
        items: @js($cartItems),
        timers: {},
        showCheckout: {{ $errors->any() ? 'true' : 'false' }},
        confirmRemoveId: null,
        nama: @js(old('nama', '')),
        alamat: @js(old('alamat', '')),

        updateUrl(id) { return @js($updateUrlTemplate).replace('__ID__', id); },
        removeUrl(id) { return @js($removeUrlTemplate).replace('__ID__', id); },

        get subtotal() {
            return this.items.reduce((sum, item) => sum + (item.harga * item.qty), 0);
        },
        get total() { return this.subtotal; },

        formatRp(value) {
            return 'Rp ' + Math.round(value).toLocaleString('id-ID');
        },

        buildWaMessage() {
            let msg = `Hii... admin Smart Maritim Community Ngemboh saya ingin memesan produk berikut: \n\n`;
            msg += `Nama: ${this.nama}\n`;
            msg += `Alamat Pengiriman: ${this.alamat}\n`;
            msg += `Nama Barang:\n`;
            this.items.forEach((item, i) => {
                msg += `${i + 1}. ${item.nama} x ${item.qty} : ${this.formatRp(item.harga * item.qty)}\n`;
            });
            msg += `Total Harga: ${this.formatRp(this.total)}`;
            return msg;
        },

        changeQty(item, delta) {
            const newQty = item.qty + delta;
            if (newQty < 1) return;

            const oldQty = item.qty;
            item.qty = newQty;

            clearTimeout(this.timers[item.id]);
            this.timers[item.id] = setTimeout(() => {
                const tokenEl = document.querySelector('meta[name=csrf-token]');
                fetch(this.updateUrl(item.id), {
                    method: 'PATCH',
                    headers: {
                        'X-CSRF-TOKEN': tokenEl.content,
                        'Content-Type': 'application/json',
                        'Accept': 'application/json',
                    },
                    body: JSON.stringify({ qty: item.qty }),
                })
                .then(res => res.json())
                .then(data => {
                    if (!data.success) {
                        item.qty = oldQty;
                        window.showToast('error', data.message);
                    } else {
                        window.dispatchEvent(new CustomEvent('cart-updated', { detail: { count: data.cart_count } }));
                    }
                })
                .catch(() => {
                    item.qty = oldQty;
                    window.showToast('error', 'Gagal memperbarui jumlah produk.');
                });
            }, 400);
        },

        removeItem(id) {
            const tokenEl = document.querySelector('meta[name=csrf-token]');
            fetch(this.removeUrl(id), {
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': tokenEl.content,
                    'Accept': 'application/json',
                },
            })
            .then(res => res.json())
            .then(data => {
                this.items = this.items.filter(i => i.id !== id);
                window.showToast('success', data.message ?? 'Produk dihapus dari keranjang.');
                window.dispatchEvent(new CustomEvent('cart-updated', { detail: { count: data.cart_count } }));
            })
            .catch(() => window.showToast('error', 'Gagal menghapus produk.'));
        },

        openWhatsApp() {
            const waNumber = '6281357340696';
            const url = `https://wa.me/${waNumber}?text=${encodeURIComponent(this.buildWaMessage())}`;
            const newTab = window.open(url, '_blank');

            if (!newTab || newTab.closed || typeof newTab.closed === 'undefined') {
                window.showToast('error', 'Popup diblokir. Klik link berikut untuk melanjutkan ke WhatsApp.');
            }
        },

        submitCheckout(formEl) {
            this.openWhatsApp();

            const tokenEl = document.querySelector('meta[name=csrf-token]');
            fetch(formEl.action, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': tokenEl.content,
                    'Accept': 'application/json',
                },
                body: new FormData(formEl),
            })
            .then(res => res.json())
            .then(data => {
                if (data.success) {
                    this.items = [];
                    window.dispatchEvent(new CustomEvent('cart-updated', { detail: { count: 0 } }));
                }
            })
            .catch(() => {});

            this.showCheckout = false;
        },
    }"
>
    <div>
        <h1 class="text-xl sm:text-2xl md:text-[32px] md:leading-10 font-bold text-[#2655B6]">Keranjang Belanja</h1>
        <p class="text-xs sm:text-sm md:text-base text-[#40484B] mt-1 sm:mt-2">Dukung komunitas lokal dengan setiap pembelian produk ramah lingkungan.</p>
    </div>

    {{-- Empty State --}}
    <template x-if="items.length === 0">
        <div class="flex flex-col items-center justify-center text-center bg-[#F6F9FF] rounded-2xl py-10 sm:py-14 md:py-20 px-4 sm:px-6">
            <div class="w-16 h-16 sm:w-20 sm:h-20 md:w-24 md:h-24 rounded-full bg-[#F6F9FF] shadow-[-6px_-6px_12px_#FFFFFF,6px_6px_12px_#BABECC] flex items-center justify-center mb-5 sm:mb-6">
                <x-heroicon-o-shopping-cart class="w-7 h-7 sm:w-8 sm:h-8 md:w-10 md:h-10 text-[#4CC71C]" />
            </div>

            <h2 class="text-lg sm:text-xl md:text-2xl font-bold text-[#171C21]">Keranjang Belanja Kosong</h2>
            <p class="text-xs sm:text-sm md:text-base text-[#40484B] mt-2 max-w-xs sm:max-w-sm">
                Sepertinya Anda belum menambahkan produk apapun. Yuk, jelajahi katalog dan dukung produk lokal Desa Ngemboh.
            </p>

            <a href="{{ route('shop.index') }}"
               class="inline-flex items-center gap-2 sm:gap-3 bg-[#4CC71C] rounded-full px-5 sm:px-8 py-2.5 sm:py-3 mt-6 sm:mt-8 text-white font-semibold text-xs sm:text-sm md:text-base shadow-[0px_1px_2px_rgba(0,0,0,0.05)] hover:bg-[#3DA617] transition">
                <x-heroicon-o-arrow-left class="w-4 h-4 sm:w-5 sm:h-5" />
                Kembali ke Katalog Belanja
            </a>
        </div>
    </template>

    <template x-if="items.length > 0">
        <div class="grid grid-cols-1 lg:grid-cols-[1fr_400px] gap-5 sm:gap-6 items-start">

            {{-- Daftar Produk --}}
            <div class="space-y-3 sm:space-y-4 md:space-y-6 min-w-0">
                <template x-for="item in items" :key="item.id">
                    <div class="flex flex-col sm:flex-row sm:items-center gap-3 sm:gap-4 md:gap-6 p-3 sm:p-4 md:p-6 bg-[#F6F9FF] rounded-xl shadow-[6px_6px_12px_#BABECC] min-w-0">

                        {{-- Baris atas di mobile: gambar + nama/harga + hapus. Jadi 1 baris utuh di sm+ --}}
                        <div class="flex items-center gap-3 sm:gap-4 md:gap-6 sm:contents">
                            <div class="w-14 h-14 sm:w-24 sm:h-24 md:w-32 md:h-32 shrink-0 flex items-center justify-center p-1 sm:p-1.5 md:p-2 bg-[#F6F9FF] rounded-lg shadow-[inset_-6px_-6px_12px_#FFFFFF,inset_6px_6px_12px_#BABECC]">
                                <img :src="item.gambar" x-show="item.gambar" class="w-full h-full object-cover rounded-md">
                                <div x-show="!item.gambar" class="w-full h-full rounded-md bg-white"></div>
                            </div>

                            <div class="flex-1 min-w-0 space-y-0.5 sm:space-y-1">
                                <p class="text-sm sm:text-base md:text-xl font-semibold text-[#171C21] truncate" x-text="item.nama"></p>
                                <p class="text-xs sm:text-sm md:text-base font-bold text-[#2655B6]" x-text="formatRp(item.harga)"></p>
                            </div>

                            <button type="button" @click="confirmRemoveId = item.id" aria-label="remove item"
                                    class="w-8 h-8 sm:w-9 sm:h-9 md:w-10 md:h-10 rounded-full flex items-center justify-center text-[#BA1A1A] hover:bg-red-50 transition shrink-0 sm:order-last">
                                <x-heroicon-o-trash class="w-4 h-4" />
                            </button>
                        </div>

                        <div class="flex flex-wrap items-center justify-between gap-2 sm:contents">
                            <div class="flex items-center gap-2 p-1 bg-[#F6F9FF] rounded-full shadow-[inset_-6px_-6px_12px_#FFFFFF,inset_6px_6px_12px_#BABECC] shrink-0">
                                <button type="button" @click="changeQty(item, -1)" aria-label="decrease quantity"
                                        class="w-8 h-8 sm:w-9 sm:h-9 md:w-10 md:h-10 rounded-full bg-[#4CC71C] shadow-[-6px_-6px_12px_#FFFFFF,6px_6px_12px_#BABECC] flex items-center justify-center text-white">
                                    <span class="block w-3.5 h-0.5 bg-white"></span>
                                </button>
                                <span class="w-7 sm:w-8 text-center text-sm sm:text-base font-bold text-[#171C21]" x-text="item.qty"></span>
                                <button type="button" @click="changeQty(item, 1)" aria-label="increase quantity"
                                        class="w-8 h-8 sm:w-9 sm:h-9 md:w-10 md:h-10 rounded-full bg-[#4CC71C] shadow-[-6px_-6px_12px_#FFFFFF,6px_6px_12px_#BABECC] flex items-center justify-center text-white">
                                    <x-heroicon-o-plus class="w-3.5 h-3.5" />
                                </button>
                            </div>

                            <div class="text-right space-y-0.5 sm:space-y-1 shrink-0 sm:w-28 md:w-32">
                                <p class="text-[9px] sm:text-[10px] md:text-xs font-semibold uppercase tracking-wide text-[#40484B]">Subtotal</p>
                                <p class="text-base sm:text-lg md:text-xl font-semibold text-[#2655B6]" x-text="formatRp(item.harga * item.qty)"></p>
                            </div>
                        </div>
                    </div>
                </template>
            </div>

            {{-- Ringkasan Pesanan --}}
            <div class="min-w-0 self-stretch">
                <div class="bg-[#F6F9FF] rounded-2xl shadow-[6px_6px_12px_#BABECC] p-4 sm:p-6 md:p-8 space-y-3 sm:space-y-4 lg:sticky lg:top-24">
                    <h2 class="text-lg sm:text-xl md:text-2xl font-bold text-[#171C21]">Ringkasan Pesanan</h2>

                    <div class="space-y-2 sm:space-y-3 py-2">
                        <div class="flex items-center justify-between">
                            <span class="text-xs sm:text-sm md:text-base text-[#40484B]">Subtotal Produk</span>
                            <span class="text-xs sm:text-sm md:text-base font-semibold text-[#171C21]" x-text="formatRp(subtotal)"></span>
                        </div>
                    </div>

                    <div class="flex items-center justify-between pt-3 sm:pt-4 border-t border-[#BFC8CB]/30">
                        <span class="text-base sm:text-lg md:text-xl font-semibold text-[#171C21]">Total</span>
                        <span class="text-xl sm:text-2xl md:text-[32px] font-bold text-[#2655B6]" x-text="formatRp(total)"></span>
                    </div>

                    <button type="button" @click="showCheckout = true" aria-label="checkout"
                            class="w-full flex items-center justify-center gap-2 sm:gap-3 bg-[#4CC71C] rounded-xl py-3 sm:py-3.5 md:py-4 text-white font-bold text-sm sm:text-base md:text-lg shadow-[0px_10px_15px_-3px_rgba(0,0,0,0.1),0px_4px_6px_-4px_rgba(0,0,0,0.1)] hover:bg-[#3DA617] transition">
                        <x-heroicon-o-chat-bubble-left-right class="w-4 h-4 sm:w-5 sm:h-5" />
                        Checkout via WhatsApp
                    </button>

                    <p class="text-center text-[11px] sm:text-xs italic font-semibold tracking-wide text-[#40484B]">
                        Pesanan Anda akan langsung diproses oleh tim Community Ngemboh.
                    </p>
                </div>
            </div>

            {{-- FIX: full-width di bawah pada layar lg, tidak lagi sejajar kolom ringkasan --}}
            <a href="{{ route('shop.index') }}" aria-label="kembali ke katalog belanja"
               class="w-fit inline-flex items-center gap-2 sm:gap-3 bg-[#4CC71C] rounded-full px-5 sm:px-8 py-2.5 sm:py-3 text-white font-semibold text-xs sm:text-sm md:text-base shadow-[0px_1px_2px_rgba(0,0,0,0.05)] hover:bg-[#3DA617] transition lg:col-span-2">
                <x-heroicon-o-arrow-left class="w-4 h-4 sm:w-5 sm:h-5" />
                Kembali ke Katalog Belanja
            </a>
        </div>
    </template>

    {{-- Modal Konfirmasi Checkout --}}
    <template x-teleport="body">
    <div x-show="showCheckout" x-cloak
         class="fixed inset-0 z-[9999] flex items-center justify-center p-3 sm:p-4"
         x-transition.opacity>
        <div class="absolute inset-0 bg-black/40 backdrop-blur-sm" @click="showCheckout = false"></div>

        <div class="relative bg-white rounded-2xl sm:rounded-3xl w-full max-w-md max-h-[92vh] sm:max-h-[85vh] flex flex-col overflow-hidden">

            {{-- Header --}}
            <div class="flex items-center justify-between px-4 sm:px-6 pt-4 sm:pt-6 pb-3 sm:pb-4 shrink-0 border-b border-[#BFC8CB]/20">
                <h2 class="text-lg sm:text-2xl font-bold text-[#2655B6]">Ringkasan Pesanan</h2>
                <button type="button" @click="showCheckout = false" aria-label="tutup" class="text-gray-400 hover:text-gray-600">
                    <x-heroicon-o-x-mark class="w-5 h-5 sm:w-6 sm:h-6" />
                </button>
            </div>

            <form action="{{ route('checkout') }}" method="POST" @submit.prevent="submitCheckout($el)" class="flex-1 flex flex-col min-h-0">
                @csrf
                <div class="flex-1 overflow-y-auto px-4 sm:px-6 py-4 space-y-4">
                    <div>
                        <label class="block text-xs font-semibold uppercase tracking-wide text-[#40484B] mb-2">Nama Pemesan</label>
                        <input type="text" name="nama" x-model="nama" required
                            class="w-full bg-[#F6F9FF] shadow-[inset_4px_4px_8px_#BABECC,inset_-4px_-4px_8px_#FFFFFF] rounded-2xl px-4 sm:px-6 py-2.5 sm:py-3 text-sm sm:text-base text-[#161D16] outline-none">
                        @error('nama') <span class="text-xs text-red-500">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <label class="block text-xs font-semibold uppercase tracking-wide text-[#40484B] mb-2">Alamat Pemesan</label>
                        <input type="text" name="alamat" x-model="alamat" required
                            class="w-full bg-[#F6F9FF] shadow-[inset_4px_4px_8px_#BABECC,inset_-4px_-4px_8px_#FFFFFF] rounded-2xl px-4 sm:px-6 py-2.5 sm:py-3 text-sm sm:text-base text-[#161D16] outline-none">
                        @error('alamat') <span class="text-xs text-red-500">{{ $message }}</span> @enderror
                    </div>

                    <div class="space-y-2">
                        <template x-for="item in items" :key="item.id">
                            <div class="flex items-center justify-between gap-3 p-3 bg-[#F6F9FF] rounded-xl shadow-[inset_-6px_-6px_12px_#FFFFFF,inset_6px_6px_12px_#BABECC]">
                                <div class="flex items-center gap-3 min-w-0">
                                    <div class="w-9 h-9 sm:w-10 sm:h-10 rounded-lg bg-[#E9EEF5] overflow-hidden shrink-0">
                                        <img :src="item.gambar" x-show="item.gambar" class="w-full h-full object-cover">
                                    </div>
                                    <div class="min-w-0">
                                        <p class="text-xs sm:text-sm font-bold text-[#171C21] truncate" x-text="item.nama"></p>
                                        <p class="text-[11px] sm:text-xs font-semibold tracking-wide text-[#40484B]" x-text="'Qty: ' + item.qty"></p>
                                    </div>
                                </div>
                                <p class="text-xs sm:text-sm font-bold text-[#2655B6] whitespace-nowrap" x-text="formatRp(item.harga * item.qty)"></p>
                            </div>
                        </template>
                    </div>
                </div>

                <div class="shrink-0 border-t border-[#BFC8CB]/30 px-4 sm:px-6 py-4 space-y-3 bg-white">
                    <div class="flex items-center justify-between">
                        <span class="text-xs sm:text-sm text-[#40484B]">Subtotal</span>
                        <span class="text-xs sm:text-sm font-medium text-[#171C21]" x-text="formatRp(subtotal)"></span>
                    </div>

                    <div class="flex items-center justify-between pt-3 border-t border-[#BFC8CB]/30">
                        <span class="text-sm sm:text-lg font-bold text-[#171C21]">Total Pembayaran</span>
                        <span class="text-lg sm:text-2xl font-bold text-[#2655B6]" x-text="formatRp(total)"></span>
                    </div>

                    <button type="submit" aria-label="konfirmasi & lanjut ke whatsapp"
                            class="w-full flex items-center justify-center gap-2 sm:gap-3 bg-[#4CC71C] shadow-[-6px_-6px_12px_#FFFFFF,6px_6px_12px_#BABECC] rounded-2xl py-3 text-white font-bold text-xs sm:text-sm md:text-base hover:bg-[#3DA617] transition">
                        <x-heroicon-o-chat-bubble-left-right class="w-4 h-4 sm:w-5 sm:h-5" />
                        Konfirmasi & Lanjut ke WhatsApp
                    </button>

                    <button type="button" @click="showCheckout = false" aria-label="batal"
                            class="w-full py-1 text-xs sm:text-sm font-medium text-[#40484B] hover:underline">
                        Batal
                    </button>
                </div>
            </form>
        </div>
    </div>
    </template>

    {{-- Modal Konfirmasi Hapus Produk --}}
    <template x-teleport="body">
    <div x-show="confirmRemoveId !== null" x-cloak
         class="fixed inset-0 z-[9999] flex items-center justify-center p-3 sm:p-4"
         x-transition.opacity>
        <div class="absolute inset-0 bg-black/40 backdrop-blur-sm" @click="confirmRemoveId = null"></div>

        <div class="relative bg-white rounded-xl w-full max-w-[400px] sm:max-w-[448px] p-5 sm:p-8 flex flex-col items-center text-center">
            <div class="w-12 h-12 sm:w-16 sm:h-16 rounded-full bg-[#F6F9FF] shadow-[inset_-6px_-6px_12px_#FFFFFF,inset_6px_6px_12px_#BABECC] flex items-center justify-center mb-4 sm:mb-6">
                <x-heroicon-o-trash class="w-5 h-5 sm:w-6 sm:h-6 text-[#BA1A1A]" />
            </div>

            <h2 class="text-lg sm:text-2xl md:text-[32px] md:leading-10 font-bold text-[#2655B6]">Hapus produk ini dari keranjang?</h2>

            <p class="text-xs sm:text-sm md:text-base text-[#40484B] mt-3 sm:mt-4">
                Tindakan ini tidak dapat dibatalkan. Produk akan dihapus secara permanen dari daftar belanja Anda.
            </p>

            <div class="flex items-center gap-3 sm:gap-4 w-full mt-5 sm:mt-8">
                <button type="button" @click="confirmRemoveId = null" aria-label="batal"
                        class="flex-1 flex items-center justify-center py-2.5 sm:py-3 bg-[#F6F9FF] shadow-[-4px_-4px_10px_#FFFFFF,4px_4px_10px_#BABECC] rounded-lg text-xs sm:text-sm font-semibold text-[#4CC71C] transition active:scale-95">
                    Batal
                </button>
                <button type="button"
                        @click="removeItem(confirmRemoveId); confirmRemoveId = null" aria-label="hapus"
                        class="flex-1 flex items-center justify-center gap-2 py-2.5 sm:py-3 bg-[#FF383C] shadow-[-4px_-4px_10px_rgba(255,255,255,0.2),4px_4px_10px_rgba(0,0,0,0.2)] rounded-lg text-xs sm:text-sm font-semibold text-white transition active:scale-95">
                    <x-heroicon-o-trash class="w-4 h-4" />
                    Hapus
                </button>
            </div>
        </div>
    </div>
    </template>
</div>
@endsection