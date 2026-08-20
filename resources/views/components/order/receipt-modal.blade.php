<div id="receipt-modal" class="hidden fixed inset-0 z-60 overflow-y-auto bg-black/70 backdrop-blur-xs flex items-center justify-center p-3 sm:p-4">
    <div class="relative w-full max-w-md bg-white dark:bg-gray-800 rounded-3xl shadow-2xl border border-gray-100 dark:border-gray-700 overflow-hidden my-auto transform transition-all">
        
        <!-- Header Receipt Modal -->
        <div class="px-6 pt-6 pb-4 text-center border-b border-dashed border-gray-200 dark:border-gray-700">
            <div class="w-12 h-12 bg-green-100 dark:bg-green-900/40 text-green-600 dark:text-green-400 rounded-full flex items-center justify-center mx-auto mb-2.5">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/>
                </svg>
            </div>
            <h3 class="text-lg font-bold text-gray-900 dark:text-white">Pembayaran Berhasil!</h3>
            <p class="text-xs text-gray-500 dark:text-gray-400 mt-0.5">Pesanan telah dicatat dan diteruskan ke dapur</p>
        </div>

        <!-- Receipt Content (Thermal Paper Aesthetic) -->
        <div id="printable-receipt" class="p-6 bg-gray-50/70 dark:bg-gray-800/60 font-mono text-xs text-gray-800 dark:text-gray-200 space-y-3">
            
            <!-- Brand Header -->
            <div class="text-center space-y-1 pb-3 border-b border-dashed border-gray-300 dark:border-gray-600">
                <h4 class="text-base font-bold tracking-wider text-gray-900 dark:text-white font-sans">SIPEMMA RESTO</h4>
                <p class="text-[11px] text-gray-500 dark:text-gray-400">Jl. Kuliner Nusantara No. 88, Jakarta</p>
                <p class="text-[11px] text-gray-500 dark:text-gray-400">Telp: 0812-3456-7890</p>
            </div>

            <!-- Metadata Info -->
            <div class="text-[11px] space-y-1 py-2 border-b border-dashed border-gray-300 dark:border-gray-600">
                <div class="flex justify-between">
                    <span class="text-gray-500 dark:text-gray-400">No. Order:</span>
                    <span id="receipt-order-id" class="font-bold">#ORD-20260820-001</span>
                </div>
                <div class="flex justify-between">
                    <span class="text-gray-500 dark:text-gray-400">Waktu:</span>
                    <span id="receipt-date">20 Aug 2026, 20:45</span>
                </div>
                <div class="flex justify-between">
                    <span class="text-gray-500 dark:text-gray-400">Pelanggan:</span>
                    <span id="receipt-customer" class="font-semibold">Umum</span>
                </div>
                <div class="flex justify-between">
                    <span class="text-gray-500 dark:text-gray-400">Tipe:</span>
                    <span id="receipt-type" class="font-semibold text-green-600 dark:text-green-400">Dine In (Meja 04)</span>
                </div>
            </div>

            <!-- Items Table -->
            <div class="py-2 border-b border-dashed border-gray-300 dark:border-gray-600 space-y-2" id="receipt-items-list">
                <!-- Dynamically populated -->
            </div>

            <!-- Totals Calculation -->
            <div class="space-y-1.5 pt-1 text-[11px]">
                <div class="flex justify-between text-gray-600 dark:text-gray-400">
                    <span>Subtotal:</span>
                    <span id="receipt-subtotal">Rp 0</span>
                </div>
                <div class="flex justify-between text-gray-600 dark:text-gray-400">
                    <span>Pajak Resto (10%):</span>
                    <span id="receipt-tax">Rp 0</span>
                </div>
                <div class="flex justify-between text-sm font-bold text-gray-900 dark:text-white pt-1 border-t border-gray-300 dark:border-gray-600">
                    <span>TOTAL:</span>
                    <span id="receipt-total" class="text-green-600 dark:text-green-400">Rp 0</span>
                </div>
                <div class="flex justify-between text-gray-600 dark:text-gray-400 pt-1">
                    <span>Metode Bayar:</span>
                    <span id="receipt-payment-method" class="font-semibold">Tunai</span>
                </div>
                <div class="flex justify-between text-gray-600 dark:text-gray-400">
                    <span>Bayar:</span>
                    <span id="receipt-pay-amount">Rp 0</span>
                </div>
                <div class="flex justify-between text-gray-600 dark:text-gray-400">
                    <span>Kembalian:</span>
                    <span id="receipt-change">Rp 0</span>
                </div>
            </div>

            <!-- Footer Message -->
            <div class="text-center pt-3 border-t border-dashed border-gray-300 dark:border-gray-600 text-[11px] text-gray-500">
                <p>Terima kasih atas kunjungan Anda! 🙏</p>
                <p class="text-[10px] text-gray-400">Silakan simpan struk ini sebagai bukti pembayaran</p>
            </div>
        </div>

        <!-- Actions -->
        <div class="p-4 bg-white dark:bg-gray-800 border-t border-gray-100 dark:border-gray-700 flex items-center gap-2.5">
            <button type="button" onclick="printReceipt()"
                class="flex-1 inline-flex items-center justify-center px-4 py-2.5 text-xs sm:text-sm font-semibold text-gray-700 dark:text-gray-200 bg-gray-100 dark:bg-gray-700 hover:bg-gray-200 dark:hover:bg-gray-600 rounded-xl transition cursor-pointer">
                <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"/>
                </svg>
                Cetak Struk
            </button>
            <button type="button" onclick="closeReceiptModal()"
                class="flex-1 inline-flex items-center justify-center px-4 py-2.5 text-xs sm:text-sm font-semibold text-white bg-green-600 hover:bg-green-700 rounded-xl shadow-md transition cursor-pointer">
                Pesanan Baru
            </button>
        </div>
    </div>
</div>
