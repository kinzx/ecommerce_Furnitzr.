<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Category extends Model
{
    use HasFactory;

    // Izinkan semua kolom diisi
    protected $guarded = ['id'];

    // Relasi kebalikan (1 Kategori punya banyak Produk)
    // Ini berguna jika nanti Anda ingin menghitung jumlah produk per kategori
    public function products(): HasMany
    {
        return $this->hasMany(Product::class);
    }
}
