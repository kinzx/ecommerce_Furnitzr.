<x-app-layout>
    <div class="py-12">
        {{-- Header Steps (Step 3: Order - AKTIF) --}}
        <div class="flex justify-center mb-10">
            <div class="bg-white px-8 py-3 rounded-full shadow-sm flex items-center space-x-4">
                <span class="font-medium text-black flex items-center gap-2">
                    <span
                        class="bg-black text-white w-6 h-6 rounded-full flex items-center justify-center text-xs">1</span>
                    Cart
                </span>
                <span class="text-gray-300">----------</span>
                <span class="font-medium text-black flex items-center gap-2">
                    <span
                        class="bg-black text-white w-6 h-6 rounded-full flex items-center justify-center text-xs">2</span>
                    Checkout
                </span>
                <span class="text-gray-300">----------</span>
                {{-- Step 3 AKTIF --}}
                <span class="font-bold text-black flex items-center gap-2">
                    <span
                        class="bg-black text-white w-6 h-6 rounded-full flex items-center justify-center text-xs">3</span>
                    Order History
                </span>
            </div>
        </div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h2 class="text-2xl font-bold mb-6">My Orders</h2>

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">

                    @if ($orders->isEmpty())
                        <div class="text-center py-10">
                            <p class="text-gray-500">You haven't made any orders yet.</p>
                            <a href="/" class="mt-4 inline-block bg-black text-white px-6 py-2 rounded-full">Start
                                Shopping</a>
                        </div>
                    @else
                        <div class="overflow-x-auto">
                            <table class="w-full text-left text-sm text-gray-500">
                                <thead class="bg-gray-50 text-xs uppercase text-gray-700">
                                    <tr>
                                        <th class="px-6 py-3">Order ID</th>
                                        <th class="px-6 py-3">Date</th>
                                        <th class="px-6 py-3">Total Price</th>
                                        <th class="px-6 py-3">Status</th>
                                        <th class="px-6 py-3">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($orders as $order)
                                        <tr class="border-b bg-white hover:bg-gray-50">
                                            <td class="px-6 py-4 font-medium text-gray-900">
                                                #{{ $order->id }}
                                            </td>
                                            <td class="px-6 py-4">
                                                {{ $order->created_at->format('d M Y') }}
                                            </td>
                                            <td class="px-6 py-4">
                                                Rp {{ number_format($order->total_price, 0, ',', '.') }}
                                            </td>
                                            <td class="px-6 py-4">
                                                {{-- 1. SUKSES (Uang masuk) --}}
                                                @if ($order->status == 'paid' || $order->status == 'settlement' || $order->status == 'capture')
                                                    <span
                                                        class="bg-green-100 text-green-800 text-xs font-medium px-2.5 py-0.5 rounded">Success</span>

                                                    {{-- 2. PENDING (Belum bayar) --}}
                                                @elseif($order->status == 'pending' || $order->status == 'unpaid')
                                                    <span
                                                        class="bg-yellow-100 text-yellow-800 text-xs font-medium px-2.5 py-0.5 rounded">Pending</span>

                                                    {{-- 3. GAGAL (Kadaluarsa/Dibatalkan/Ditolak) --}}
                                                @else
                                                    {{-- Menangkap status: expire, deny, cancel, failure --}}
                                                    <span
                                                        class="bg-red-100 text-red-800 text-xs font-medium px-2.5 py-0.5 rounded">Failed/Expired</span>
                                                @endif
                                            </td>
                                            <td class="px-6 py-4">
                                                <a href="#" class="font-medium text-blue-600 hover:underline">View
                                                    Details</a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @endif

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
