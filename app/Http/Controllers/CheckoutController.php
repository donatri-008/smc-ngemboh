<?php

namespace App\Http\Controllers;

class CheckoutController extends Controller
{
    public function redirectToWhatsapp()
    {
        $cart = session()->get('cart', []);

        if (empty($cart)) {
            return redirect()->route('cart.index')->with('error', 'Keranjang masih kosong.');
        }

        $nomorWA = '6281357340696';

        $pesan = "Halo Smart Maritim Community Ngemboh, saya ingin memesan produk berikut:%0a%0a";
        $total = 0;

        foreach ($cart as $item) {
            $subtotal = $item['harga'] * $item['qty'];
            $total += $subtotal;
            $pesan .= "- {$item['nama']} x{$item['qty']} = Rp" . number_format($subtotal, 0, ',', '.') . "%0a";
        }
        $pesan .= "%0aTotal: Rp" . number_format($total, 0, ',', '.');

        session()->forget('cart');
        return redirect("https://wa.me/{$nomorWA}?text={$pesan}");
    }
}
