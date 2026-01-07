<?php

namespace App\Filament\Resources\Categories\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;
// Tambahkan 2 baris import ini di bagian atas:
use Filament\Forms\Set;
use Illuminate\Support\Str;

class CategoryForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([

                // 1. BAGIAN NAME (Diedit)
                TextInput::make('name')
                    ->required()
                    ->maxLength(255)
                    // Aktifkan live update saat kursor pindah (klik luar)
                    ->live(onBlur: true)
                    // Saat 'name' berubah, jalankan fungsi ini:
                    // Hapus kata 'Set' dan '?string', cukup variabelnya saja
                    ->afterStateUpdated(fn($set, $state) => $set('slug', Str::slug($state))),

                // 2. BAGIAN SLUG (Diedit)
                TextInput::make('slug')
                    ->required()
                    ->maxLength(255)
                    ->readOnly() // Agar tidak bisa diedit manual (opsional, bisa dihapus jika ingin bisa edit)
                    ->unique(ignoreRecord: true), // Pastikan slug unik di database
            ]);
    }
}
