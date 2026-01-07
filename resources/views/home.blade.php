<x-app-layout>

    {{-- NAVBAR --}}


    {{-- HERO SECTION --}}
    <header class="px-6 py-12 mx-auto max-w-7xl lg:py-24">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-12 items-center">
            <div>
                {{-- Ganti Judul Utama --}}
                <h1 class="text-6xl md:text-8xl font-bold mb-6 leading-tight">Furnitzr.</h1>
                <p class="text-gray-500 mb-8 max-w-md leading-relaxed">
                    Bedroom explore different bed styles, mattresses, dressers, and nightstands to create a relaxing and
                    functional space.
                </p>

                <div class="mb-8">
                    <p class="font-bold text-lg mb-1">Honoring Dedication With</p>
                    <p class="font-bold text-lg">Enduring Comfort</p>
                    <p class="text-3xl font-light mt-4">Upto 70% Off</p>
                </div>

                <div class="flex space-x-4 items-center">
                    <button
                        class="bg-[#1a1a1a] text-white px-8 py-4 text-sm font-semibold hover:bg-gray-800 transition">Shop
                        Now &rarr;</button>
                    <a href="#" class="text-sm border-b border-black pb-1 hover:text-gray-600 transition">know
                        more &rarr;</a>
                </div>
            </div>

            <div class="relative bg-white p-8 rounded-xl shadow-sm">
                @if (isset($products) && $products->isNotEmpty())
                    <img src="{{ Storage::url($products->first()->image) }}" alt="Hero"
                        class="w-full h-[400px] object-cover rounded-lg mix-blend-multiply">
                @else
                    <div class="w-full h-[400px] bg-gray-200 rounded-lg flex items-center justify-center text-gray-400">
                        Furnitzr Hero Image
                    </div>
                @endif

                <div class="absolute -bottom-6 -left-6 bg-white p-4 shadow-lg rounded-lg hidden lg:block">
                    <p class="text-xs text-gray-500">New Arrival</p>
                    <p class="font-bold">Wooden Series</p>
                </div>
            </div>
        </div>
    </header>

    {{-- COLLECTIONS --}}
    <section class="px-6 py-16 mx-auto max-w-7xl">
        <div class="flex justify-between items-end mb-12">
            <h2 class="text-3xl md:text-4xl font-bold">Exclusive Collections</h2>
            <a href="#" class="text-sm font-medium border-b border-black pb-1 hover:text-gray-600">all products
                &rarr;</a>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-10">
            @if (isset($products))
                @foreach ($products as $product)
                    <div class="group"> {{-- Container Utama --}}

                        <div class="relative bg-white aspect-[4/3] overflow-hidden rounded-lg mb-4 shadow-sm">

                            {{-- 1. LINK PADA GAMBAR (Agar gambar bisa diklik) --}}
                            <a href="{{ route('product.details', $product->id) }}">
                                <img src="{{ Storage::url($product->image) }}"
                                    class="w-full h-full object-cover group-hover:scale-105 transition duration-500"
                                    alt="{{ $product->name }}">
                            </a>

                            {{-- Tombol Add to Cart (Tetap di sini, jangan dibungkus link agar fungsinya tidak bentrok) --}}
                            <div
                                class="absolute bottom-4 right-4 translate-y-10 opacity-0 group-hover:translate-y-0 group-hover:opacity-100 transition duration-300">
                                <button
                                    class="bg-black text-white p-3 rounded-full shadow-lg hover:bg-gray-800 transition">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M12 4.5v15m7.5-7.5h-15" />
                                    </svg>
                                </button>
                            </div>
                        </div>

                        <div>
                            {{-- 2. LINK PADA JUDUL (Agar teks judul bisa diklik) --}}
                            <a href="{{ route('product.details', $product->id) }}">
                                <h3 class="font-bold text-lg text-gray-900 hover:text-gray-600 transition">
                                    {{ $product->name }}
                                </h3>
                            </a>

                            <p class="text-sm text-gray-500 mt-1">{{ $product->category->name ?? 'Furniture' }}</p>
                            <p class="font-semibold mt-2">Rp {{ number_format($product->price, 0, ',', '.') }}</p>
                        </div>
                    </div>
                @endforeach
            @endif
        </div>
    </section>


    <section class="px-6 py-16 mx-auto max-w-7xl">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-12">
            <div class="lg:col-span-4 self-center">
                {{-- Ganti Text Curated --}}
                <h2 class="text-4xl font-bold mb-6">Curated By <br> Furnitzr.</h2>
                <p class="text-gray-600 mb-8 leading-relaxed">
                    We make furniture with a perfect blend of craftsmanship and creativity, turning raw materials into
                    timeless pieces.
                </p>
                <a href="#" class="text-sm font-bold border-b-2 border-black pb-1">Explore Design &rarr;</a>
            </div>
            <div class="lg:col-span-8 grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="bg-white p-8 rounded-lg flex items-center justify-center min-h-[300px] shadow-sm">
                    <div class="text-center">
                        <span class="block text-4xl mb-2">🪑</span>
                        <span class="text-gray-400 font-light">Living Room</span>
                    </div>
                </div>
                <div class="bg-[#f0ece6] p-8 rounded-lg flex items-center justify-center min-h-[300px] shadow-sm">
                    <div class="text-center">
                        <span class="block text-4xl mb-2">🛋️</span>
                        <span class="text-gray-500 font-light">Lounge Sets</span>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- FOOTER --}}
    <footer class="bg-white border-t border-gray-100 py-12 mt-12">
        <div class="px-6 mx-auto max-w-7xl flex flex-col md:flex-row justify-between items-start md:items-center">
            <div class="mb-6 md:mb-0">
                {{-- Ganti Brand Footer --}}
                <h4 class="text-2xl font-bold mb-2">Furnitzr.</h4>
                <p class="text-gray-400 text-sm">subscribe for newsletter</p>
                <div class="mt-4 flex">
                    <input type="email" placeholder="Enter your email"
                        class="bg-gray-100 px-4 py-2 text-sm outline-none w-full md:w-auto">
                    <button class="bg-black text-white px-4 py-2 text-xs font-bold">SUBMIT</button>
                </div>
            </div>
            <div class="flex space-x-12 text-sm text-gray-600">
                <div>
                    <h5 class="font-bold text-black mb-3">Product</h5>
                    <ul class="space-y-2">
                        <li><a href="#" class="hover:text-black">Chairs</a></li>
                        <li><a href="#" class="hover:text-black">Tables</a></li>
                    </ul>
                </div>
                <div>
                    <h5 class="font-bold text-black mb-3">Help</h5>
                    <ul class="space-y-2">
                        <li><a href="#" class="hover:text-black">Customer Service</a></li>
                        <li><a href="#" class="hover:text-black">Track Order</a></li>
                    </ul>
                </div>
            </div>
        </div>
        <div
            class="px-6 mx-auto max-w-7xl mt-12 pt-8 border-t border-gray-100 flex justify-between text-xs text-gray-400">
            <p>Privacy | Terms and Conditions</p>
            {{-- Ganti Copyright --}}
            <p>&copy; {{ date('Y') }} Furnitzr All right reserved</p>
        </div>
    </footer>

</x-app-layout>
