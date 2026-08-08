<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CheckoutController extends Controller
{
    public function redirectToWhatsapp(Request $request)
    {
        $cart = session()->get('cart', []);

        if (empty($cart)) {
            $message = 'Keranjang masih kosong.';

            if ($request->wantsJson()) {
                return response()->json(['success' => false, 'message' => $message]);
            }
            return redirect()->route('cart.index')->with('error', $message);
        }

        $request->validate([
            'nama'   => 'required|string|max:255',
            'alamat' => 'required|string|max:500',
        ]);

        try {
            DB::transaction(function () use ($cart) {
                foreach ($cart as $productId => $item) {
                    // lockForUpdate() mengunci baris produk ini sampai transaksi selesai,
                    // supaya checkout lain yang barengan tidak baca stok "lama" (mencegah race condition/overselling)
                    $product = Product::where('id', $productId)->lockForUpdate()->first();

                    if (! $product || $product->stok < $item['qty']) {
                        throw new \RuntimeException(
                            "Stok \"{$item['nama']}\" tidak lagi mencukupi (tersisa " . ($product->stok ?? 0) . "). Silakan sesuaikan jumlah di keranjang."
                        );
                    }

                    $product->decrement('stok', $item['qty']);
                }
            });
        } catch (\RuntimeException $e) {
            if ($request->wantsJson()) {
                return response()->json(['success' => false, 'message' => $e->getMessage()]);
            }
            return redirect()->route('cart.index')->with('error', $e->getMessage());
        }

        session()->forget('cart');

        $message = 'Pesanan berhasil diproses. Selesaikan pemesanan lewat WhatsApp.';

        if ($request->wantsJson()) {
            return response()->json(['success' => true, 'message' => $message]);
        }

        return redirect()->route('shop.index')->with('success', $message);
    }
}