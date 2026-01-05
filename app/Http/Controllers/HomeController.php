<?php

namespace App\Http\Controllers;
use App\Models\Product;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        // Sekarang controller sudah kenal Product, jadi tidak error lagi
        $products = Product::where('is_active', true)->latest()->get();

        return view('home', compact('products'));
    }
}
