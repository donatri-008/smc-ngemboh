@extends('layouts.app')
@section('title', 'Belanja - Smart Maritim Community Ngemboh')

@section('content')
<div class="pt-10 space-y-6">
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        <h1 class="text-2xl font-bold text-gray-700">Belanja</h1>
        <form method="GET" class="flex gap-3">
            <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari produk..."
                class="bg-neu shadow-neu-in rounded-xl px-4 py-2 text-sm outline-none">
            <select name="kategori" class="bg-neu shadow-neu-in rounded-xl px-4 py-2 text-sm outline-none">
                <option value="">Semua Kategori</option>
                <option value="lapak" {{ request('kategori') === 'lapak' ? 'selected' : '' }}>Lapak</option>
                <option value="produk_luaran" {{ request('kategori') === 'produk_luaran' ? 'selected' : '' }}>Produk Luaran</option>
            </select>
            <x-ui.button type="submit">Cari</x-ui.button>
        </form>
    </div>

    <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
        @forelse($products as $product)
        <a href="{{ route('shop.show', $product) }}" class="block">
            <x-ui.card padding="p-4" class="space-y-2 hover:shadow-neu-in transition">
                @if($product->gambar)
                <img src="{{ Storage::url($product->gambar) }}" class="w-full h-32 rounded-xl object-cover shadow-neu-in">
                @else
                <div class="w-full h-32 rounded-xl bg-neu shadow-neu-in"></div>
                @endif
                <p class="text-sm font-medium text-gray-700 truncate">{{ $product->nama }}</p>
                <p class="text-sm text-indigo-600 font-semibold">Rp{{ number_format($product->harga, 0, ',', '.') }}</p>
                <p class="text-xs {{ $product->stok <= 5 ? 'text-red-500' : 'text-gray-400' }}">Stok: {{ $product->stok }}</p>
            </x-ui.card>
        </a>
        @empty
        <x-ui.empty-state message="Produk tidak ditemukan." />
        @endforelse
    </div>

    {{ $products->appends(request()->query())->links() }}
</div>
@endsection