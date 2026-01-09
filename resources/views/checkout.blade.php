<x-app-layout>
    <div class="py-12">
        {{-- Header Steps (Visual Indikator Tahap 2) --}}
        <div class="flex justify-center mb-10">
            <div class="bg-white px-8 py-3 rounded-full shadow-sm flex items-center space-x-4">

                {{-- Step 1: Cart (Sudah Lewat) --}}
                <span class="font-medium text-black flex items-center gap-2">
                    <span
                        class="bg-black text-white w-6 h-6 rounded-full flex items-center justify-center text-xs">1</span>
                    Cart
                </span>

                <span class="text-gray-300">----------</span>

                {{-- Step 2: Checkout (SEDANG AKTIF) --}}
                <span class="font-bold text-black flex items-center gap-2">
                    <span
                        class="bg-black text-white w-6 h-6 rounded-full flex items-center justify-center text-xs">2</span>
                    Checkout
                </span>

                <span class="text-gray-300">----------</span>

                {{-- Step 3: Order (Belum) --}}
                <span class="text-gray-400">Order</span>
            </div>
        </div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-white p-6 rounded-2xl shadow-sm text-center">
                <h2 class="text-2xl font-bold mb-4">Payment Confirmation</h2>
                <p class="text-gray-600 mb-8">Order ID: #{{ $order->id }}</p>
                <p class="text-3xl font-bold mb-8">Rp {{ number_format($order->total_price, 0, ',', '.') }}</p>

                <button id="pay-button"
                    class="bg-black text-white px-8 py-3 rounded-full font-bold hover:bg-gray-800 transition">
                    Pay Now via Midtrans
                </button>
            </div>
        </div>
    </div>

    {{-- Script Midtrans --}}
    <script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ config('midtrans.client_key') }}">
    </script>
    <script type="text/javascript">
        document.getElementById('pay-button').onclick = function() {
            // SnapToken acquired from previous step
            snap.pay('{{ $order->snap_token }}', {
                // Optional
                onSuccess: function(result) {
                    /* You may add your own implementation here */
                    alert("payment success!");
                    window.location.href = '/orders'; // Redirect kemana setelah sukses
                },
                onPending: function(result) {
                    /* You may add your own implementation here */
                    alert("wating your payment!");
                    console.log(result);
                },
                onError: function(result) {
                    /* You may add your own implementation here */
                    alert("payment failed!");
                    console.log(result);
                },
                onClose: function() {
                    /* User menutup popup tanpa membayar */
                    alert('Anda membatalkan pembayaran.');

                    // Opsional: Redirect kembali ke halaman Cart atau Dashboard
                    window.location.href = '/cart?status=canceled';
                }
            });
        };
    </script>
</x-app-layout>
