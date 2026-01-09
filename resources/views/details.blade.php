<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            {{-- Breadcrumb (Navigasi Kecil) --}}
            <nav class="text-sm text-gray-500 mb-6">
                <a href="/" class="hover:text-black">Home</a> /
                <span class="text-black font-medium">{{ $product->name }}</span>
            </nav>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-10 bg-white p-6 rounded-2xl shadow-sm">

                {{-- KOLOM KIRI: GAMBAR --}}
                <div class="space-y-4">
                    <div class="aspect-[4/3] w-full overflow-hidden rounded-xl bg-gray-100">
                        <img src="{{ Storage::url($product->image) }}" alt="{{ $product->name }}"
                            class="w-full h-full object-cover">
                    </div>

                    {{-- Thumbnail Kecil (Opsional/Hiasan) --}}
                    <div class="grid grid-cols-4 gap-4">
                        <div
                            class="aspect-square rounded-lg bg-gray-100 overflow-hidden cursor-pointer border-2 border-black">
                            <img src="{{ Storage::url($product->image) }}" class="w-full h-full object-cover">
                        </div>
                    </div>
                </div>

                {{-- KOLOM KANAN: INFORMASI --}}
                <div>
                    <h1 class="text-3xl font-bold text-gray-900">{{ $product->name }}</h1>
                    <p class="text-xl font-medium text-gray-900 mt-2">Rp
                        {{ number_format($product->price, 0, ',', '.') }}</p>

                    {{-- Deskripsi --}}
                    <div class="mt-6">
                        <h3 class="text-sm font-medium text-gray-900">Description</h3>
                        <p class="mt-2 text-gray-500 text-sm leading-relaxed">
                            {{ $product->description }}
                        </p>
                    </div>

                    {{-- Quantity & Actions --}}
                    <div x-data="{ count: 1 }" class="mt-8">

                        {{-- FORM PEMBUNGKUS --}}
                        <form action="{{ route('cart.add', $product->id) }}" method="POST"
                            class="flex flex-col sm:flex-row gap-4">
                            @csrf

                            {{-- INPUT TERSEMBUNYI: Ini cara mengirim nilai Alpine 'count' ke Laravel --}}
                            <input type="hidden" name="quantity" :value="count">

                            {{-- UI Quantity (Alpine JS) --}}
                            <div class="flex items-center border border-gray-300 rounded-lg w-fit">
                                <button type="button" @click="count > 1 ? count-- : count = 1"
                                    class="px-3 py-2 text-gray-600 hover:bg-gray-100 font-bold">-</button>
                                <span x-text="count"
                                    class="px-3 py-2 text-gray-900 font-medium w-12 text-center">1</span>
                                <button type="button" @click="count++"
                                    class="px-3 py-2 text-gray-600 hover:bg-gray-100 font-bold">+</button>
                            </div>

                            {{-- Tombol Add to Cart (Type = 'add') --}}
                            <button type="submit" name="type" value="add"
                                class="flex-1 bg-white border border-gray-300 text-gray-900 py-3 rounded-full font-medium hover:bg-gray-50 transition">
                                Add to Cart
                            </button>

                            {{-- Tombol Buy Now (Type = 'buy_now') --}}
                            <button type="submit" name="type" value="buy_now"
                                class="flex-1 bg-black text-white py-3 rounded-full font-medium hover:bg-gray-800 transition shadow-lg">
                                Buy Now
                            </button>
                        </form>
                    </div>

                    {{-- Info Pengiriman (Statis sesuai desain) --}}
                    <div class="mt-8 border-t border-gray-100 pt-6 grid grid-cols-2 gap-4">
                        <div class="flex items-start gap-3">
                            <div class="p-2 bg-gray-50 rounded-full">📦</div>
                            <div>
                                <p class="text-xs font-bold text-gray-900">Free Shipping</p>
                                <p class="text-xs text-gray-500">On orders over Rp 1jt</p>
                            </div>
                        </div>
                        <div class="flex items-start gap-3">
                            <div class="p-2 bg-gray-50 rounded-full">🛡️</div>
                            <div>
                                <p class="text-xs font-bold text-gray-900">Warranty</p>
                                <p class="text-xs text-gray-500">100% Original Product</p>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
