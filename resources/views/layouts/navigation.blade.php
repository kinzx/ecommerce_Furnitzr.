<nav class="px-6 py-6 mx-auto max-w-7xl flex justify-between items-center">
    {{-- Logo --}}
    <a href="/" class="text-3xl font-bold tracking-tighter">Furnitzr.</a>

    <div class="flex items-center space-x-6 text-sm font-medium">
        @if (Route::has('login'))
            @auth
                {{-- AREA USER LOGIN (DROPDOWN) --}}
                <div class="relative" x-data="{ open: false }">
                    {{-- 1. Tombol Trigger (Nama User) --}}
                    <button @click="open = !open"
                        class="flex items-center gap-1 hover:text-gray-600 focus:outline-none transition">
                        <span>Hi, {{ Auth::user()->name }}</span>
                        {{-- Ikon Panah Bawah --}}
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="w-4 h-4 mt-0.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="m19.5 8.25-7.5 7.5-7.5-7.5" />
                        </svg>
                    </button>

                    {{-- 2. Isi Dropdown --}}
                    <div x-show="open" @click.away="open = false" x-transition:enter="transition ease-out duration-200"
                        x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100"
                        x-transition:leave="transition ease-in duration-75" x-transition:leave-start="opacity-100 scale-100"
                        x-transition:leave-end="opacity-0 scale-95"
                        class="absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg border border-gray-100 py-1 z-50 origin-top-right"
                        style="display: none;">

                        {{-- Menu Profile / Dashboard (Tergantung Role) --}}
                        @if (Auth::user()->role === 'admin')
                            <a href="/admin" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                Dashboard Admin
                            </a>
                        @else
                            <a href="{{ route('profile.edit') }}"
                                class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                Settings Profile
                            </a>
                        @endif

                        <hr class="border-gray-100 my-1">

                        {{-- Menu Logout --}}
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit"
                                class="w-full text-left block px-4 py-2 text-sm text-red-600 hover:bg-red-50 hover:text-red-700">
                                Log Out
                            </button>
                        </form>
                    </div>
                </div>
            @else
                {{-- AREA TAMU (BELUM LOGIN) --}}
                <a href="{{ route('login') }}" class="hover:text-gray-600">Login</a>
                @if (Route::has('register'))
                    <a href="{{ route('register') }}"
                        class="border border-black px-5 py-2 hover:bg-black hover:text-white transition rounded-full">Register</a>
                @endif
            @endauth
        @endif

        {{-- Tombol Keranjang Belanja --}}
        <a href="{{ route('cart.view') }}">
            <button class="p-2 hover:bg-gray-200 rounded-full transition relative group">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M15.75 10.5V6a3.75 3.75 0 10-7.5 0v4.5m11.356-1.993l1.263 12c.07.665-.45 1.243-1.119 1.243H4.25a1.125 1.125 0 01-1.12-1.243l1.264-12A1.125 1.125 0 015.513 7.5h12.974c.576 0 1.059.435 1.119 1.007z" />
                </svg>

                @auth
                    @php
                        // Hitung jumlah item di keranjang user
                        $cartCount = \App\Models\Cart::where('user_id', Auth::id())->count();
                    @endphp

                    @if ($cartCount > 0)
                        <span
                            class="absolute top-0 right-0 inline-flex items-center justify-center px-2 py-1 text-xs font-bold leading-none text-white transform translate-x-1/4 -translate-y-1/4 bg-red-600 rounded-full">
                            {{ $cartCount }}
                        </span>
                    @endif
                @endauth
            </button>
        </a>
    </div>
</nav>
