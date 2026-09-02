<x-layout>
    <x-slot:title>
        {{ $title }}
    </x-slot:title>

    <div class="max-w-4xl mx-auto">
        <!-- Header -->
        <div class="mb-6 flex items-center justify-between">
            <div>
                <h1 class="text-2xl font-bold text-gray-900 dark:text-white">Pembayaran Pesanan</h1>
                <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">Selesaikan pembayaran untuk pesanan {{ $order->order_number }}</p>
            </div>
            <a href="{{ route('order.index') }}" class="text-sm font-medium text-gray-500 hover:text-gray-700 dark:text-gray-400 dark:hover:text-gray-200 bg-white dark:bg-gray-800 px-4 py-2 rounded-xl border border-gray-200 dark:border-gray-700 shadow-sm transition">
                Kembali ke POS
            </a>
        </div>

        @if(session('error'))
            <div class="mb-6 p-4 bg-red-50 dark:bg-red-900/30 border border-red-200 dark:border-red-800 rounded-2xl flex items-start gap-3 text-red-700 dark:text-red-400 text-sm font-medium">
                <svg class="w-5 h-5 shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>
                <p>{{ session('error') }}</p>
            </div>
        @endif

        <div class="grid grid-cols-1 lg:grid-cols-12 gap-6 items-start">
            
            <!-- LEFT COLUMN: Order Summary -->
            <div class="lg:col-span-7 space-y-6">
                <!-- Order Details Card -->
                <div class="bg-white dark:bg-gray-800 rounded-2xl border border-gray-100 dark:border-gray-700 shadow-sm overflow-hidden">
                    <div class="p-5 border-b border-gray-100 dark:border-gray-700 bg-gray-50/50 dark:bg-gray-800/50 flex justify-between items-center">
                        <h2 class="font-bold text-gray-900 dark:text-white flex items-center gap-2">
                            <svg class="w-5 h-5 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path></svg>
                            Ringkasan Pesanan
                        </h2>
                        <span class="px-2.5 py-1 text-xs font-bold rounded-lg bg-yellow-100 text-yellow-800 dark:bg-yellow-900/30 dark:text-yellow-400">
                            {{ $order->status }}
                        </span>
                    </div>
                    
                    <div class="p-5">
                        <div class="grid grid-cols-2 gap-4 mb-6 text-sm">
                            <div>
                                <span class="block text-gray-500 dark:text-gray-400 mb-1">Nomor Pesanan</span>
                                <span class="font-bold text-gray-900 dark:text-white">{{ $order->order_number }}</span>
                            </div>
                            <div>
                                <span class="block text-gray-500 dark:text-gray-400 mb-1">Pelanggan</span>
                                <span class="font-bold text-gray-900 dark:text-white">{{ $order->customer_name }}</span>
                            </div>
                            <div>
                                <span class="block text-gray-500 dark:text-gray-400 mb-1">Tipe Pesanan</span>
                                <span class="font-bold text-gray-900 dark:text-white">{{ $order->order_type }} {{ $order->table_number ? '('.$order->table_number.')' : '' }}</span>
                            </div>
                            <div>
                                <span class="block text-gray-500 dark:text-gray-400 mb-1">Waktu Pesan</span>
                                <span class="font-bold text-gray-900 dark:text-white">{{ $order->created_at->format('d M Y, H:i') }}</span>
                            </div>
                        </div>

                        <div class="space-y-4">
                            <h3 class="text-xs font-bold text-gray-400 uppercase tracking-wider mb-2">Item Pesanan</h3>
                            @foreach($order->items as $item)
                            <div class="flex justify-between items-start">
                                <div>
                                    <h4 class="font-medium text-gray-900 dark:text-white text-sm">{{ $item->menu_name }}</h4>
                                    <p class="text-xs text-gray-500 dark:text-gray-400 mt-0.5">
                                        {{ $item->quantity }} x {{ 'Rp ' . number_format($item->price, 0, ',', '.') }}
                                        @if($item->notes)
                                            <span class="block italic text-yellow-600 dark:text-yellow-500 mt-0.5">Catatan: {{ $item->notes }}</span>
                                        @endif
                                    </p>
                                </div>
                                <span class="font-bold text-gray-900 dark:text-white text-sm">{{ 'Rp ' . number_format($item->subtotal, 0, ',', '.') }}</span>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>

            <!-- RIGHT COLUMN: Payment Action -->
            <div class="lg:col-span-5 space-y-6">
                
                <!-- Calculation Breakdown -->
                <div class="bg-white dark:bg-gray-800 p-5 rounded-2xl border border-gray-100 dark:border-gray-700 shadow-sm space-y-3.5">
                    <div class="space-y-2 text-sm">
                        <div class="flex justify-between text-gray-500 dark:text-gray-400">
                            <span>Subtotal</span>
                            <span class="font-medium text-gray-800 dark:text-gray-200">{{ $order->formatted_subtotal }}</span>
                        </div>
                        <div class="flex justify-between text-gray-500 dark:text-gray-400">
                            <span>Pajak Restoran (10%)</span>
                            <span class="font-medium text-gray-800 dark:text-gray-200">{{ $order->formatted_tax }}</span>
                        </div>
                        @if($order->discount > 0)
                        <div class="flex justify-between text-green-600 dark:text-green-400">
                            <span>Diskon</span>
                            <span class="font-medium">- Rp {{ number_format($order->discount, 0, ',', '.') }}</span>
                        </div>
                        @endif
                        <div class="flex justify-between items-center pt-3 border-t border-gray-200 dark:border-gray-700">
                            <span class="text-base font-bold text-gray-900 dark:text-white">Total Tagihan</span>
                            <span class="text-2xl font-extrabold text-green-600 dark:text-green-400">{{ $order->formatted_total }}</span>
                        </div>
                    </div>
                </div>

                <!-- Payment Methods -->
                <div class="bg-white dark:bg-gray-800 p-5 rounded-2xl border border-gray-100 dark:border-gray-700 shadow-sm">
                    <h3 class="font-bold text-gray-900 dark:text-white mb-4">Pilih Metode Pembayaran</h3>
                    
                    <div class="grid grid-cols-2 gap-3 mb-6">
                        <button type="button" onclick="selectPayment('cash')" id="btn-pay-cash"
                            class="flex flex-col items-center justify-center py-4 px-2 rounded-xl border-2 border-green-500 bg-green-50 dark:bg-green-900/20 text-green-700 dark:text-green-400 font-bold transition cursor-pointer">
                            <svg class="w-6 h-6 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                            Uang Tunai
                        </button>
                        
                        <button type="button" onclick="selectPayment('midtrans')" id="btn-pay-midtrans"
                            class="flex flex-col items-center justify-center py-4 px-2 rounded-xl border border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-800 hover:bg-gray-50 dark:hover:bg-gray-700 text-gray-600 dark:text-gray-300 font-bold transition cursor-pointer">
                            <svg class="w-6 h-6 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"></path></svg>
                            QRIS / Virtual Account
                        </button>
                    </div>

                    <!-- Cash Payment Form -->
                    <form action="{{ route('payment.cash', $order->order_number) }}" method="POST" id="form-cash" class="space-y-4">
                        @csrf
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-1.5">Uang Diterima</label>
                            <div class="relative">
                                <span class="absolute inset-y-0 left-0 flex items-center pl-3 text-gray-500 font-bold">Rp</span>
                                <input type="number" name="cash_received" id="cash_received" required min="{{ $order->total_amount }}" oninput="calculateChange()"
                                    class="w-full pl-10 pr-4 py-2.5 bg-gray-50 dark:bg-gray-900 border border-gray-200 dark:border-gray-600 rounded-xl text-gray-900 dark:text-white font-bold text-lg focus:ring-2 focus:ring-green-500 focus:border-green-500"
                                    placeholder="0" value="{{ $order->total_amount }}" />
                            </div>
                        </div>

                        <div class="flex items-center gap-2 mb-2 overflow-x-auto pb-2 text-xs font-medium no-scrollbar">
                            <button type="button" onclick="setCash({{ $order->total_amount }})" class="px-3 py-1.5 bg-gray-100 hover:bg-gray-200 dark:bg-gray-700 dark:hover:bg-gray-600 rounded-lg text-gray-700 dark:text-gray-200 shrink-0">Uang Pas</button>
                            <button type="button" onclick="setCash(50000)" class="px-3 py-1.5 bg-gray-100 hover:bg-gray-200 dark:bg-gray-700 dark:hover:bg-gray-600 rounded-lg text-gray-700 dark:text-gray-200 shrink-0">50.000</button>
                            <button type="button" onclick="setCash(100000)" class="px-3 py-1.5 bg-gray-100 hover:bg-gray-200 dark:bg-gray-700 dark:hover:bg-gray-600 rounded-lg text-gray-700 dark:text-gray-200 shrink-0">100.000</button>
                        </div>

                        <div class="flex justify-between items-center p-3 bg-gray-50 dark:bg-gray-900/50 rounded-xl border border-gray-100 dark:border-gray-700/50">
                            <span class="text-sm text-gray-500 dark:text-gray-400">Kembalian</span>
                            <span id="change_amount" class="text-lg font-bold text-gray-900 dark:text-white">Rp 0</span>
                        </div>

                        <button type="submit"
                            class="w-full mt-4 flex justify-center items-center gap-2 py-3.5 px-4 bg-green-600 hover:bg-green-700 text-white text-sm font-bold rounded-xl shadow-md hover:shadow-lg transition">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                            Konfirmasi Pembayaran
                        </button>
                    </form>

                    <!-- Midtrans Payment Form (Placeholder) -->
                    <div id="form-midtrans" class="hidden text-center py-6">
                        <div class="inline-flex items-center justify-center w-16 h-16 rounded-full bg-blue-50 dark:bg-blue-900/20 text-blue-500 mb-4">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
                        </div>
                        <h4 class="font-bold text-gray-900 dark:text-white mb-2">Integrasi Midtrans Belum Aktif</h4>
                        <p class="text-sm text-gray-500 dark:text-gray-400 px-4">
                            Fitur pembayaran menggunakan Midtrans sedang dalam tahap persiapan dan akan segera hadir.
                        </p>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <script>
        const totalAmount = {{ $order->total_amount }};
        
        function selectPayment(method) {
            const btnCash = document.getElementById('btn-pay-cash');
            const btnMidtrans = document.getElementById('btn-pay-midtrans');
            const formCash = document.getElementById('form-cash');
            const formMidtrans = document.getElementById('form-midtrans');

            if (method === 'cash') {
                // Style Active
                btnCash.className = "flex flex-col items-center justify-center py-4 px-2 rounded-xl border-2 border-green-500 bg-green-50 dark:bg-green-900/20 text-green-700 dark:text-green-400 font-bold transition cursor-pointer";
                btnMidtrans.className = "flex flex-col items-center justify-center py-4 px-2 rounded-xl border border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-800 hover:bg-gray-50 dark:hover:bg-gray-700 text-gray-600 dark:text-gray-300 font-bold transition cursor-pointer";
                
                formCash.classList.remove('hidden');
                formMidtrans.classList.add('hidden');
                calculateChange();
            } else {
                // Style Active
                btnMidtrans.className = "flex flex-col items-center justify-center py-4 px-2 rounded-xl border-2 border-blue-500 bg-blue-50 dark:bg-blue-900/20 text-blue-700 dark:text-blue-400 font-bold transition cursor-pointer";
                btnCash.className = "flex flex-col items-center justify-center py-4 px-2 rounded-xl border border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-800 hover:bg-gray-50 dark:hover:bg-gray-700 text-gray-600 dark:text-gray-300 font-bold transition cursor-pointer";
                
                formCash.classList.add('hidden');
                formMidtrans.classList.remove('hidden');
            }
        }

        function formatRupiah(amount) {
            return 'Rp ' + Number(amount).toLocaleString('id-ID');
        }

        function calculateChange() {
            const input = document.getElementById('cash_received');
            const display = document.getElementById('change_amount');
            const val = Number(input.value) || 0;
            
            if (val >= totalAmount) {
                const change = val - totalAmount;
                display.innerText = formatRupiah(change);
                display.className = "text-lg font-bold text-green-600 dark:text-green-400";
            } else {
                display.innerText = "Rp 0";
                display.className = "text-lg font-bold text-gray-900 dark:text-white";
            }
        }

        function setCash(amount) {
            document.getElementById('cash_received').value = amount;
            calculateChange();
        }

        // Initialize
        calculateChange();
    </script>
</x-layout>
