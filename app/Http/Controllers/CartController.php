<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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

    // Hapus Barang
    public function destroy($id)
    {
        Cart::where('id', $id)->where('user_id', Auth::id())->delete();
        return redirect()->route('cart.view')->with('success', 'Item removed!');
    }
}
