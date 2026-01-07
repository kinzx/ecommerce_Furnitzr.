<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CartController; // <--- Pastikan CartController di-import

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // === BAGIAN KERANJANG BELANJA (CART) ===

    // 1. Melihat isi keranjang
    Route::get('/cart', [CartController::class, 'index'])->name('cart.view');

    // 2. Menambah barang ke keranjang
    Route::post('/cart/add/{id}', [CartController::class, 'store'])->name('cart.add');

    // 3. Update jumlah barang (+ atau -)
    Route::patch('/cart/update/{id}', [CartController::class, 'update'])->name('cart.update');

    // 4. Hapus barang dari keranjang
    Route::delete('/cart/remove/{id}', [CartController::class, 'destroy'])->name('cart.remove');

    // === END CART ===

    Route::get('/checkout', function () {
        return "Halaman Pembayaran (Checkout)";
    })->name('checkout');
});

Route::get('/product/{id}', [HomeController::class, 'details'])->name('product.details');

require __DIR__ . '/auth.php';
