<x-app-layout>
    <div class="py-12 bg-gray-50 min-h-screen">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            {{-- Header Steps (Visual Saja) --}}
            <div class="flex justify-center mb-10">
                <div class="bg-white px-8 py-3 rounded-full shadow-sm flex items-center space-x-4">
                    <span class="font-bold text-black flex items-center gap-2">
                        <span
                            class="bg-black text-white w-6 h-6 rounded-full flex items-center justify-center text-xs">1</span>
                        Cart
                    </span>
                    <span class="text-gray-300">----------</span>
                    <span class="text-gray-400">Checkout</span>
                    <span class="text-gray-300">----------</span>
                    <span class="text-gray-400">Order</span>
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

                {{-- KOLOM KIRI: DAFTAR PRODUK --}}
                <div class="lg:col-span-2 space-y-4">

                    {{-- Judul Tabel --}}
                    <div class="flex justify-between text-sm text-gray-500 border-b border-gray-200 pb-2 mb-4">
                        <span>Product</span>
                        <span>Total</span>
                    </div>

                    @forelse ($cartItems as $item)
                        <div
                            class="bg-white p-4 rounded-xl shadow-sm border border-gray-100 flex flex-col sm:flex-row items-center gap-6">

                            {{-- Gambar Produk --}}
                            <div class="w-24 h-24 bg-gray-100 rounded-lg overflow-hidden shrink-0">
                                <img src="{{ Storage::url($item->product->image) }}" class="w-full h-full object-cover">
                            </div>

                            {{-- Info Produk --}}
                            <div class="flex-1 text-center sm:text-left">
                                <h3 class="font-bold text-gray-900 text-lg">{{ $item->product->name }}</h3>
                                <p class="text-gray-500 text-sm">{{ $item->product->category->name ?? 'Furniture' }}</p>
                                <p class="text-gray-900 font-medium mt-1">Rp
                                    {{ number_format($item->product->price, 0, ',', '.') }}</p>
                            </div>

                            {{-- Quantity Spinner --}}
                            <div class="flex items-center border border-gray-300 rounded-lg h-10">
                                {{-- Tombol Kurang --}}
                                <form action="{{ route('cart.update', $item->id) }}" method="POST">
                                    @csrf @method('PATCH')
                                    <input type="hidden" name="type" value="decrement">
                                    <button type="submit"
                                        class="px-3 text-gray-600 hover:bg-gray-100 h-full rounded-l-lg">-</button>
                                </form>

                                <span
                                    class="px-3 font-medium text-gray-900 border-x border-gray-300 w-10 text-center">{{ $item->quantity }}</span>

                                {{-- Tombol Tambah --}}
                                <form action="{{ route('cart.update', $item->id) }}" method="POST">
                                    @csrf @method('PATCH')
                                    <input type="hidden" name="type" value="increment">
                                    <button type="submit"
                                        class="px-3 text-gray-600 hover:bg-gray-100 h-full rounded-r-lg">+</button>
                                </form>
                            </div>

                            {{-- Tombol Hapus (Tong Sampah) --}}
                            <form action="{{ route('cart.remove', $item->id) }}" method="POST">
                                @csrf @method('DELETE')
                                <button
                                    class="p-2 bg-gray-100 hover:bg-red-50 text-gray-500 hover:text-red-600 rounded-lg transition">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                                    </svg>
                                </button>
                            </form>

                            {{-- Total Harga Per Item --}}
                            <div class="font-bold text-gray-900 w-32 text-right">
                                Rp {{ number_format($item->product->price * $item->quantity, 0, ',', '.') }}
                            </div>
                        </div>
                    @empty
                        {{-- Tampilan Jika Kosong --}}
                        <div class="text-center py-20 bg-white rounded-xl">
                            <p class="text-gray-500 text-lg">Your cart is empty.</p>
                            <a href="/" class="mt-4 inline-block text-black font-bold underline">Go Shopping</a>
                        </div>
                    @endforelse

                    <div class="mt-8">
                        <a href="/"
                            class="flex items-center text-gray-500 hover:text-black transition gap-2 font-medium">
                            ← Go back to shopping
                        </a>
                    </div>
                </div>

                {{-- KOLOM KANAN: ORDER SUMMARY (Kotak Biru) --}}
                <div class="lg:col-span-1">
                    <div class="bg-[#003B95] text-white p-6 rounded-2xl shadow-lg sticky top-6">
                        <h2 class="text-xl font-bold mb-6">Order Summary</h2>

                        <div class="space-y-4 text-sm mb-6">
                            <div class="flex justify-between text-blue-100">
                                <span>Subtotal</span>
                                <span>Rp {{ number_format($subtotal, 0, ',', '.') }}</span>
                            </div>
                            <div class="flex justify-between text-blue-100">
                                <span>V.A.T (11%)</span>
                                <span>Rp {{ number_format($tax, 0, ',', '.') }}</span>
                            </div>
                        </div>

                        <div class="border-t border-blue-800 my-6 pt-6">
                            <div class="flex justify-between items-center text-lg font-bold">
                                <span>Total</span>
                                <span>Rp {{ number_format($total, 0, ',', '.') }}</span>
                            </div>
                        </div>

                        <a href="{{ route('checkout.process') }}"
                            class="block w-full text-center bg-[#FFD700] text-black font-bold py-4 rounded-xl hover:bg-yellow-400 transition shadow-lg mt-4">
                            Proceed to checkout
                        </a>
                    </div>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>
