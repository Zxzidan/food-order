<div id="report-receipt-modal" class="hidden fixed inset-0 z-60 overflow-y-auto bg-black/70 backdrop-blur-xs flex items-center justify-center p-3 sm:p-4">
    <div class="relative w-full max-w-md bg-white dark:bg-gray-800 rounded-3xl shadow-2xl border border-gray-100 dark:border-gray-700 overflow-hidden my-auto transform transition-all">
        
        <div class="px-6 pt-5 pb-3 flex items-center justify-between border-b border-gray-100 dark:border-gray-700">
            <h3 class="text-base font-bold text-gray-900 dark:text-white">Rincian Struk Transaksi</h3>
            <button type="button" onclick="closeReportReceiptModal()" class="text-gray-400 hover:text-gray-600 dark:hover:text-gray-200 p-1 rounded-lg">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>
        </div>

        <!-- Receipt Content -->
        <div id="report-printable-area" class="p-6 bg-gray-50/80 dark:bg-gray-800 font-mono text-xs text-gray-800 dark:text-gray-200 space-y-3">
            <div class="text-center space-y-1 pb-3 border-b border-dashed border-gray-300 dark:border-gray-600">
                <h4 class="text-base font-bold tracking-wider text-gray-900 dark:text-white font-sans">SIPEMMA RESTO</h4>
                <p class="text-[11px] text-gray-500 dark:text-gray-400">Jl. Kuliner Nusantara No. 88, Jakarta</p>
                <p class="text-[11px] text-gray-500 dark:text-gray-400">Telp: 0812-3456-7890</p>
            </div>

            <div class="text-[11px] space-y-1 py-2 border-b border-dashed border-gray-300 dark:border-gray-600">
                <div class="flex justify-between">
                    <span class="text-gray-500 dark:text-gray-400">No. Order:</span>
                    <span id="modal-receipt-order-id" class="font-bold">--</span>
                </div>
                <div class="flex justify-between">
                    <span class="text-gray-500 dark:text-gray-400">Waktu:</span>
                    <span id="modal-receipt-date">--</span>
                </div>
                <div class="flex justify-between">
                    <span class="text-gray-500 dark:text-gray-400">Pelanggan:</span>
                    <span id="modal-receipt-customer" class="font-semibold">--</span>
                </div>
                <div class="flex justify-between">
                    <span class="text-gray-500 dark:text-gray-400">Tipe:</span>
                    <span id="modal-receipt-type" class="font-semibold text-blue-600 dark:text-blue-400">--</span>
                </div>
            </div>

            <!-- Items list -->
            <div class="py-2 border-b border-dashed border-gray-300 dark:border-gray-600 space-y-2" id="modal-receipt-items">
                <!-- Populated via JS -->
            </div>

            <!-- Totals -->
            <div class="space-y-1.5 pt-1 text-[11px]">
                <div class="flex justify-between text-gray-600 dark:text-gray-400">
                    <span>Subtotal:</span>
                    <span id="modal-receipt-subtotal">Rp 0</span>
                </div>
                <div class="flex justify-between text-gray-600 dark:text-gray-400">
                    <span>Pajak Resto (10%):</span>
                    <span id="modal-receipt-tax">Rp 0</span>
                </div>
                <div class="flex justify-between text-sm font-bold text-gray-900 dark:text-white pt-1 border-t border-gray-300 dark:border-gray-600">
                    <span>TOTAL:</span>
                    <span id="modal-receipt-total" class="text-emerald-600 dark:text-emerald-400">Rp 0</span>
                </div>
                <div class="flex justify-between text-gray-600 dark:text-gray-400 pt-1">
                    <span>Metode Bayar:</span>
                    <span id="modal-receipt-payment" class="font-semibold">--</span>
                </div>
            </div>
        </div>

        <!-- Modal Action Buttons -->
        <div class="p-4 bg-white dark:bg-gray-800 border-t border-gray-100 dark:border-gray-700 flex items-center gap-2.5">
            <button type="button" onclick="printSingleReceipt()"
                class="flex-1 inline-flex items-center justify-center px-4 py-2.5 text-xs sm:text-sm font-semibold text-gray-700 dark:text-gray-200 bg-gray-100 dark:bg-gray-700 hover:bg-gray-200 dark:hover:bg-gray-600 rounded-xl transition cursor-pointer">
                <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"/>
                </svg>
                Cetak Struk Ini
            </button>
            <button type="button" onclick="closeReportReceiptModal()"
                class="flex-1 inline-flex items-center justify-center px-4 py-2.5 text-xs sm:text-sm font-semibold text-white bg-blue-600 hover:bg-blue-700 rounded-xl shadow-sm transition cursor-pointer">
                Tutup
            </button>
        </div>
    </div>
</div>
