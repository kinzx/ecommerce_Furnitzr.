<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Product extends Model
{
    use HasFactory;

    // KUNCI 1: Izinkan semua kolom diisi (biar tidak error saat save di Filament)
    protected $guarded = ['id'];

    // KUNCI 2: Relasi ke Category (Setiap Produk punya 1 Kategori)
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }
}
