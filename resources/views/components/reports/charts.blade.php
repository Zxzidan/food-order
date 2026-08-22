<div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
    
    <!-- Main Revenue & Order Volume Chart (2 Cols) -->
    <div class="lg:col-span-2 bg-white dark:bg-gray-800 p-5 sm:p-6 rounded-2xl border border-gray-100 dark:border-gray-700 shadow-2xs">
        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-3 mb-6">
            <div>
                <h2 class="text-base sm:text-lg font-bold text-gray-900 dark:text-white">Tren Pendapatan & Pesanan</h2>
                <p class="text-xs text-gray-500 dark:text-gray-400">Grafik akumulasi penjualan harian dalam periode terpilih</p>
            </div>
            
            <div class="flex items-center gap-2">
                <span class="inline-flex items-center gap-1.5 text-xs text-blue-600 dark:text-blue-400 font-semibold bg-blue-50 dark:bg-blue-900/30 px-2.5 py-1 rounded-lg">
                    <span class="w-2 h-2 rounded-full bg-blue-600 dark:bg-blue-400"></span> Pendapatan
                </span>
                <span class="inline-flex items-center gap-1.5 text-xs text-emerald-600 dark:text-emerald-400 font-semibold bg-emerald-50 dark:bg-emerald-900/30 px-2.5 py-1 rounded-lg">
                    <span class="w-2 h-2 rounded-full bg-emerald-600 dark:bg-emerald-400"></span> Pesanan
                </span>
            </div>
        </div>

        <div id="revenue-trend-chart" class="w-full min-h-[320px]"></div>
    </div>

    <!-- Payment Methods & Category Distribution (1 Col) -->
    <div class="space-y-6">
        <!-- Payment Method Donut -->
        <div class="bg-white dark:bg-gray-800 p-5 sm:p-6 rounded-2xl border border-gray-100 dark:border-gray-700 shadow-2xs">
            <div class="flex items-center justify-between mb-4">
                <div>
                    <h2 class="text-base font-bold text-gray-900 dark:text-white">Metode Pembayaran</h2>
                    <p class="text-xs text-gray-500 dark:text-gray-400">Porsi metode transaksi pelanggan</p>
                </div>
            </div>
            <div id="payment-methods-chart" class="w-full flex justify-center py-2"></div>
        </div>

        <!-- Financial Quick Summary Card -->
        <div class="bg-gradient-to-br from-blue-600 to-indigo-700 text-white p-5 rounded-2xl shadow-md">
            <h3 class="text-sm font-semibold uppercase tracking-wider text-blue-100">Ringkasan Keuangan Bersih</h3>
            <div class="mt-3 space-y-2 text-xs">
                <div class="flex justify-between text-blue-100">
                    <span>Penjualan Kotor (Gross):</span>
                    <span class="font-medium text-white">Rp 28.450.000</span>
                </div>
                <div class="flex justify-between text-blue-100">
                    <span>Diskon & Promo:</span>
                    <span class="font-medium text-amber-300">- Rp 450.000</span>
                </div>
                <div class="flex justify-between text-blue-100">
                    <span>Pajak Resto (10%):</span>
                    <span class="font-medium text-white">Rp 2.800.000</span>
                </div>
                <div class="pt-2 border-t border-blue-400/40 flex justify-between text-sm font-bold">
                    <span>Pendapatan Bersih:</span>
                    <span class="text-emerald-300">Rp 25.200.000</span>
                </div>
            </div>
        </div>
    </div>

</div>
