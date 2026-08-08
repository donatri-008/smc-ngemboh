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
            ->latest()->paginate(8);

        return view('shop.index', compact('products'));
    }

    public function show(Product $product)
    {
        $product->load('images');
        return view('shop.show', compact('product'));
    }

    public function addToCart(Product $product, Request $request)
    {
        $cart = session()->get('cart', []);
        $qty = max(1, (int) $request->input('qty', 1));

        $qtySudahDiCart = $cart[$product->id]['qty'] ?? 0;
        $totalDiminta = $qtySudahDiCart + $qty;

        if ($totalDiminta > $product->stok) {
            $sisaBisaDitambah = max(0, $product->stok - $qtySudahDiCart);
            $message = $sisaBisaDitambah > 0
                ? "Stok \"{$product->nama}\" tidak cukup. Sisa stok yang bisa ditambahkan: {$sisaBisaDitambah}."
                : "Stok \"{$product->nama}\" sudah habis atau sudah mencapai batas di keranjang.";

            if ($request->wantsJson()) {
                return response()->json(['success' => false, 'message' => $message]);
            }

            return redirect()->back()->with('error', $message);
        }

        if (isset($cart[$product->id])) {
            $cart[$product->id]['qty'] = $totalDiminta;
        } else {
            $cart[$product->id] = ['nama' => $product->nama, 'harga' => $product->harga, 'qty' => $qty, 'gambar' => $product->gambar,];
        }

        session()->put('cart', $cart);

        $message = 'Produk ditambahkan ke keranjang';
        $cartCount = collect($cart)->sum('qty');

        if ($request->wantsJson()) {
            return response()->json([
                'success' => true,
                'message' => $message,
                'cart_count' => $cartCount,
            ]);
        }

        return redirect()->back()->with('success', $message);
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
            $message = "Jumlah melebihi stok tersedia ({$product->stok}) untuk \"{$product->nama}\".";

            if ($request->wantsJson()) {
                return response()->json(['success' => false, 'message' => $message]);
            }

            return redirect()->route('cart.index')->with('error', $message);
        }

        if (isset($cart[$product->id])) {
            $cart[$product->id]['qty'] = $qty;
            session()->put('cart', $cart);
        }

        $cartCount = collect($cart)->sum('qty');

        if ($request->wantsJson()) {
            return response()->json([
                'success' => true,
                'message' => 'Jumlah produk diperbarui.',
                'cart_count' => $cartCount,
            ]);
        }

        return redirect()->route('cart.index')->with('success', 'Jumlah produk diperbarui.');
    }

    public function removeFromCart(Product $product, Request $request)
    {
        $cart = session()->get('cart', []);
        unset($cart[$product->id]);
        session()->put('cart', $cart);

        $cartCount = collect($cart)->sum('qty');

        if ($request->wantsJson()) {
            return response()->json([
                'success' => true,
                'message' => 'Produk dihapus dari keranjang.',
                'cart_count' => $cartCount,
            ]);
        }

        return redirect()->route('cart.index')->with('success', 'Produk dihapus dari keranjang.');
    }
}