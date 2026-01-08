<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Str;

class SocialiteController extends Controller
{
    // 1. Arahkan User ke Halaman Login Google
    public function redirect()
    {
        return Socialite::driver('google')->redirect();
    }

    // 2. Handle Balikan (Callback) dari Google
    public function callback()
    {
        try {
            // Ambil data user dari Google
            $googleUser = Socialite::driver('google')->user();

            // Cari user di database berdasarkan Email
            $user = User::where('email', $googleUser->getEmail())->first();

            if ($user) {
                // Jika email ada, update google_id (untuk koneksi) lalu login
                $user->update([
                    'google_id' => $googleUser->getId(),
                ]);

                Auth::login($user);
                return redirect()->intended('/dashboard'); // Atau ke Home

            } else {
                // Jika email belum ada, buat user baru (Register otomatis)
                $newUser = User::create([
                    'name' => $googleUser->getName(),
                    'email' => $googleUser->getEmail(),
                    'google_id' => $googleUser->getId(),
                    'password' => bcrypt(Str::random(16)), // Password acak (karena login via Google)
                    'role' => 'user', // Set default role
                ]);

                Auth::login($newUser);
                return redirect()->intended('/dashboard');
            }

        } catch (\Exception $e) {
            // Jika error (misal user cancel), kembalikan ke login
            return redirect()->route('login')->with('error', 'Login Google gagal, silakan coba lagi.');
        }
    }
}
