<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use App\Models\Order;            // <--- WAJIB ADA (Untuk simpan order)
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Midtrans\Config;             // <--- WAJIB ADA (Untuk setting Midtrans)
use Midtrans\Snap;
class CartController extends Controller
{
    // Menampilkan Halaman Cart
    public function index()
    {
        // Ambil data keranjang user yang sedang login
        $cartItems = Cart::with('product')
            ->where('user_id', Auth::id())
            ->get();

        // Hitung Subtotal, Pajak, dan Total
        $subtotal = $cartItems->sum(function ($item) {
            return $item->product->price * $item->quantity;
        });
        $tax = $subtotal * 0.11; // Contoh PPN 11%
        $total = $subtotal + $tax;

        return view('cart', compact('cartItems', 'subtotal', 'tax', 'total'));
    }

    // Menambah Barang (Store)
    public function store(Request $request, $id)
    {
        $existingCart = Cart::where('user_id', Auth::id())
            ->where('product_id', $id)
            ->first();

        if ($existingCart) {
            $existingCart->increment('quantity', $request->quantity ?? 1);
        } else {
            Cart::create([
                'user_id' => Auth::id(),
                'product_id' => $id,
                'quantity' => $request->quantity ?? 1
            ]);
        }

        return redirect()->back()->with('success', 'Product added to cart!');
    }

    // Update Jumlah (+/-)
    public function update(Request $request, $id)
    {
        $cart = Cart::where('id', $id)->where('user_id', Auth::id())->firstOrFail();

        if ($request->type == 'increment') {
            $cart->increment('quantity');
        } elseif ($request->type == 'decrement' && $cart->quantity > 1) {
            $cart->decrement('quantity');
        }

        return redirect()->route('cart.view');
    }

    public function checkout()
    {
        // 1. Ambil data keranjang
        $cartItems = \App\Models\Cart::where('user_id', Auth::id())->get();

        // Validasi keranjang kosong
        if ($cartItems->isEmpty()) {
            return redirect()->route('cart.view');
        }

        // 2. Hitung Total (Sama seperti sebelumnya)
        $subtotal = $cartItems->sum(function ($item) {
            return $item->product->price * $item->quantity;
        });
        $total = $subtotal + ($subtotal * 0.11); // PPN 11%

        // 3. Simpan ke Tabel Orders
        $order = Order::create([
            'user_id' => Auth::id(),
            'total_price' => $total,
            'status' => 'unpaid',
        ]);

        // 4. Konfigurasi Midtrans
        Config::$serverKey = config('midtrans.server_key');
        Config::$isProduction = config('midtrans.is_production');
        Config::$isSanitized = config('midtrans.is_sanitized');
        Config::$is3ds = config('midtrans.is_3ds');

        // 5. Siapkan Parameter untuk Midtrans
        $params = [
            'transaction_details' => [
                'order_id' => $order->id . '-' . time(), // ID Unik (tambah time agar tidak duplikat saat tes)
                'gross_amount' => (int) $total,
            ],
            'customer_details' => [
                'first_name' => Auth::user()->name,
                'email' => Auth::user()->email,
            ],
        ];

        // 6. Minta Snap Token
        $snapToken = Snap::getSnapToken($params);

        // 7. Simpan Snap Token ke Database
        $order->snap_token = $snapToken;
        $order->save();

        // 8. Hapus Keranjang (Opsional, biasanya dihapus setelah bayar sukses, tapi untuk simpel hapus skrg)
        // \App\Models\Cart::where('user_id', Auth::id())->delete();

        // 9. Tampilkan Halaman Pembayaran
        return view('checkout', compact('order', 'snapToken', 'cartItems'));
    }

    // Hapus Barang
    public function destroy($id)
    {
        Cart::where('id', $id)->where('user_id', Auth::id())->delete();
        return redirect()->route('cart.view')->with('success', 'Item removed!');
    }
}
