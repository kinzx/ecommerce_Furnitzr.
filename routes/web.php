<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\SocialiteController;

// 1. Halaman Depan (Bisa diakses siapa saja)
Route::get('/', [HomeController::class, 'index'])->name('home');

// 2. Detail Produk (Bisa diakses siapa saja)
Route::get('/product/{id}', [HomeController::class, 'details'])->name('product.details');

// 3. Login & Register via Google (Bisa diakses siapa saja)
Route::get('/auth/google', [SocialiteController::class, 'redirect'])->name('google.login');
Route::get('/auth/google/callback', [SocialiteController::class, 'callback'])->name('google.callback');

// 4. Dashboard (Wajib Login)
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// === GROUP KHUSUS USER LOGIN ===
Route::middleware('auth')->group(function () {

    // Fitur Profile Bawaan Breeze
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // === FITUR KERANJANG (CART) ===
    Route::get('/cart', [CartController::class, 'index'])->name('cart.view');
    Route::post('/cart/add/{id}', [CartController::class, 'store'])->name('cart.add');
    Route::patch('/cart/update/{id}', [CartController::class, 'update'])->name('cart.update');
    Route::delete('/cart/remove/{id}', [CartController::class, 'destroy'])->name('cart.remove');

    // === FITUR CHECKOUT (PAYMENT) ===
    // Letakkan di sini, menggantikan kode dummy sebelumnya
    Route::get('/checkout-process', [CartController::class, 'checkout'])->name('checkout.process');

});

require __DIR__ . '/auth.php';
