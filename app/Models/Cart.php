<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    protected $fillable = ['user_id', 'product_id', 'quantity'];

    // Relasi ke Produk (Agar nanti bisa ambil nama & harga produk dari keranjang)
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
