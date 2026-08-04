<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ShopController extends Controller
{
    public function index(Request $request)
    {
        $products = Product::query()
            ->when($request->kategori, fn ($q) => $q->where('kategori', $request->kategori))
            ->when($request->search, fn ($q) => $q->where('nama', 'like', '%' . $request->search . '%'))
            ->latest()->paginate(12);

        return view('shop.index', compact('products'));
    }

    public function show(Product $product)
    {
        return view('shop.show', compact('product'));
    }

    public function addToCart(Product $product, Request $request)
    {
        $cart = session()->get('cart', []);
        $qty = max(1, (int) $request->input('qty', 1));

        // total qty yang diminta = qty baru + qty yang sudah ada di cart
        $qtySudahDiCart = $cart[$product->id]['qty'] ?? 0;
        $totalDiminta = $qtySudahDiCart + $qty;

        if ($totalDiminta > $product->stok) {
            $sisaBisaDitambah = max(0, $product->stok - $qtySudahDiCart);

            return redirect()->back()->with(
                'error',
                $sisaBisaDitambah > 0
                    ? "Stok \"{$product->nama}\" tidak cukup. Sisa stok yang bisa ditambahkan: {$sisaBisaDitambah}."
                    : "Stok \"{$product->nama}\" sudah habis atau sudah mencapai batas di keranjang."
            );
        }

        if (isset($cart[$product->id])) {
            $cart[$product->id]['qty'] = $totalDiminta;
        } else {
            $cart[$product->id] = ['nama' => $product->nama, 'harga' => $product->harga, 'qty' => $qty];
        }

        session()->put('cart', $cart);
        return redirect()->back()->with('success', 'Produk ditambahkan ke keranjang');
    }

    public function cart()
    {
        $cart = session()->get('cart', []);
        return view('shop.cart', compact('cart'));
    }

    public function updateQuantity(Product $product, Request $request)
    {
        $cart = session()->get('cart', []);
        $qty = max(1, (int) $request->input('qty', 1));

        if ($qty > $product->stok) {
            return redirect()->route('cart.index')
                ->with('error', "Jumlah melebihi stok tersedia ({$product->stok}) untuk \"{$product->nama}\".");
        }

        if (isset($cart[$product->id])) {
            $cart[$product->id]['qty'] = $qty;
            session()->put('cart', $cart);
        }

        return redirect()->route('cart.index')->with('success', 'Jumlah produk diperbarui.');
    }

    public function removeFromCart(Product $product)
    {
        $cart = session()->get('cart', []);
        unset($cart[$product->id]);
        session()->put('cart', $cart);

        return redirect()->route('cart.index')->with('success', 'Produk dihapus dari keranjang.');
    }
}