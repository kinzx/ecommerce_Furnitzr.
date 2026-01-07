<?php

namespace App\Filament\Widgets;

use App\Models\Category; // <--- Import Model Category
use App\Models\Product;  // <--- Import Model Product
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsOverview extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            // Statistik 1: Mengambil jumlah semua produk
            Stat::make('Total Produk', Product::count())
                ->description('Stok tersedia di toko')
                ->descriptionIcon('heroicon-m-arrow-trending-up')
                ->color('success'),

            // Statistik 2: Mengambil jumlah semua kategori
            Stat::make('Total Kategori', Category::count())
                ->description('Jenis furniture')
                ->descriptionIcon('heroicon-m-tag')
                ->color('primary'),

        ];
    }
}
