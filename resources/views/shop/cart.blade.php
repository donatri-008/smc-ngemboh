@extends('layouts.app')
@section('title', 'Keranjang - Smart Maritim Community Ngemboh')

@section('content')
<div class="pt-10 space-y-6">
    <h1 class="text-2xl font-bold text-gray-700">Keranjang Belanja</h1>

    @if(count($cart) === 0)
    <x-ui.empty-state message="Keranjang masih kosong." />
    <a href="{{ route('shop.index') }}" class="inline-block text-sm text-indigo-500 hover:underline">&larr; Lanjut belanja</a>
    @else
    <x-ui.card padding="p-4" class="divide-y divide-gray-200/60">
        @php $total = 0; @endphp
        @foreach($cart as $productId => $item)
        @php $subtotal = $item['harga'] * $item['qty']; $total += $subtotal; @endphp
        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-3 py-4">
            <div>
                <p class="font-medium text-gray-700">{{ $item['nama'] }}</p>
                <p class="text-xs text-gray-500">Rp{{ number_format($item['harga'], 0, ',', '.') }} x {{ $item['qty'] }}</p>
            </div>

            <div class="flex items-center gap-3">
                <form action="{{ route('cart.update', $productId) }}" method="POST" class="flex items-center gap-2">
                    @csrf @method('PATCH')
                    <input type="number" name="qty" value="{{ $item['qty'] }}" min="1"
                        class="w-16 bg-neu shadow-neu-in rounded-xl px-3 py-1 text-sm outline-none">
                    <button class="text-xs text-indigo-500 hover:underline">Update</button>
                </form>

                <form action="{{ route('cart.remove', $productId) }}" method="POST">
                    @csrf @method('DELETE')
                    <button class="text-xs text-red-500 hover:underline">Hapus</button>
                </form>

                <p class="text-sm font-semibold text-gray-700 w-28 text-right">Rp{{ number_format($subtotal, 0, ',', '.') }}</p>
            </div>
        </div>
        @endforeach
    </x-ui.card>

    <x-ui.card class="flex items-center justify-between">
        <p class="font-semibold text-gray-700">Total</p>
        <p class="text-xl font-bold text-indigo-600">Rp{{ number_format($total, 0, ',', '.') }}</p>
    </x-ui.card>

    <form action="{{ route('checkout') }}" method="POST">
        @csrf
        <x-ui.button type="submit" variant="success" class="w-full">Checkout via WhatsApp</x-ui.button>
    </form>
    @endif
</div>
@endsection