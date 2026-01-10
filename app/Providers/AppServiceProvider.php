<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\URL; // <--- 1. Tambahkan ini di atas

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        // 2. Tambahkan kode ini agar Ngrok mendeteksi HTTPS
        if (config('app.env') !== 'local') {
            URL::forceScheme('https');
        }

        // ATAU CARA PALING KASAR (Tapi Ampuh untuk Demo Ngrok):
        // Paksa HTTPS jika URL mengandung ngrok
        if (str_contains(request()->url(), 'ngrok-free.app')) {
            URL::forceScheme('https');
        }
    }
}
