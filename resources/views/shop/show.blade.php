@extends('layouts.app')
@section('title', $product->nama)

@section('content')
<div class="pt-10 grid grid-cols-1 md:grid-cols-2 gap-10">
    <div>
        @if($product->gambar)
        <img src="{{ Storage::url($product->gambar) }}" class="w-full rounded-2xl shadow-neu-out">
        @else
        <div class="w-full h-72 rounded-2xl bg-neu shadow-neu-out"></div>
        @endif
    </div>

    <div class="space-y-4">
        <x-ui.badge>{{ $product->kategori === 'lapak' ? 'Lapak' : 'Produk Luaran' }}</x-ui.badge>
        <h1 class="text-2xl font-bold text-gray-700">{{ $product->nama }}</h1>
        <p class="text-xl text-indigo-600 font-semibold">Rp{{ number_format($product->harga, 0, ',', '.') }}</p>
        <p class="text-sm text-gray-500">{{ $product->deskripsi }}</p>
        <p class="text-sm {{ $product->stok <= 5 ? 'text-red-500' : 'text-gray-500' }}">Stok tersedia: {{ $product->stok }}</p>

        @if($product->stok > 0)
        <form action="{{ route('cart.add', $product) }}" method="POST" class="flex items-center gap-3">
            @csrf
            <input type="number" name="qty" value="1" min="1" max="{{ $product->stok }}"
                class="w-20 bg-neu shadow-neu-in rounded-xl px-4 py-2 text-sm outline-none">
            <x-ui.button type="submit">+ Tambah ke Keranjang</x-ui.button>
        </form>
        @else
        <p class="text-sm text-red-500 font-medium">Stok habis</p>
        @endif
    </div>
</div>
@endsection