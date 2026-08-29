<div class="bg-white dark:bg-gray-800 p-4 sm:p-5 rounded-2xl border border-gray-100 dark:border-gray-700 shadow-2xs space-y-4">
    
    <!-- Top Filter Row: Status Tabs & View Switcher -->
    <div class="flex flex-col lg:flex-row lg:items-center justify-between gap-4 pb-3 border-b border-gray-100 dark:border-gray-700">
        <!-- Status Tab Pills -->
        <div class="flex items-center flex-wrap gap-1.5 bg-gray-100/80 dark:bg-gray-700/60 p-1 rounded-xl">
            <button type="button" onclick="filterByStatus('all', this)"
                class="history-status-tab px-3 py-1.5 rounded-lg text-xs font-semibold bg-white dark:bg-gray-800 text-blue-600 dark:text-blue-400 shadow-2xs transition cursor-pointer">
                Semua (45)
            </button>
            <button type="button" onclick="filterByStatus('Selesai', this)"
                class="history-status-tab px-3 py-1.5 rounded-lg text-xs font-semibold text-gray-600 dark:text-gray-300 hover:text-gray-900 dark:hover:text-white transition cursor-pointer">
                Selesai (42)
            </button>
            <button type="button" onclick="filterByStatus('Diproses', this)"
                class="history-status-tab px-3 py-1.5 rounded-lg text-xs font-semibold text-gray-600 dark:text-gray-300 hover:text-gray-900 dark:hover:text-white transition cursor-pointer">
                Diproses (2)
            </button>
            <button type="button" onclick="filterByStatus('Dibatalkan', this)"
                class="history-status-tab px-3 py-1.5 rounded-lg text-xs font-semibold text-gray-600 dark:text-gray-300 hover:text-gray-900 dark:hover:text-white transition cursor-pointer">
                Dibatalkan (1)
            </button>
        </div>

        <!-- View Switcher (Table vs Card) -->
        <div class="flex items-center gap-2">
            <span class="text-xs text-gray-500 dark:text-gray-400 hidden sm:inline">Tampilan:</span>
            <div class="flex items-center bg-gray-100 dark:bg-gray-700 p-1 rounded-xl">
                <button type="button" id="btn-view-table" onclick="setViewMode('table')" title="Tampilan Tabel"
                    class="p-1.5 rounded-lg bg-white dark:bg-gray-800 text-blue-600 dark:text-blue-400 shadow-2xs transition cursor-pointer">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 10h16M4 14h16M4 18h16" />
                    </svg>
                </button>
                <button type="button" id="btn-view-cards" onclick="setViewMode('cards')" title="Tampilan Kartu"
                    class="p-1.5 rounded-lg text-gray-500 dark:text-gray-400 hover:text-gray-900 dark:hover:text-white transition cursor-pointer">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Bottom Filter Row: Search & Dropdowns -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-12 gap-3">
        
        <!-- Search Input (5 Cols) -->
        <div class="lg:col-span-5 relative">
            <input type="search" id="history-search-input" onkeyup="applyHistoryFilters()"
                placeholder=""
                class="w-full pl-10 pr-4 py-2.5 bg-gray-50 dark:bg-gray-700/70 border border-gray-200 dark:border-gray-600 text-gray-900 dark:text-white text-xs sm:text-sm rounded-xl focus:ring-2 focus:ring-blue-500 placeholder:text-gray-400" />
            <div class="absolute inset-y-0 left-0 flex items-center pl-3.5 pointer-events-none text-gray-400">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m21 21-3.5-3.5M17 10a7 7 0 1 1-14 0 7 7 0 0 1 14 0Z" />
                </svg>
            </div>
        </div>

        <!-- Metode Pembayaran Dropdown (2 Cols) -->
        <div class="lg:col-span-2">
            <select id="history-payment-filter" onchange="applyHistoryFilters()"
                class="w-full px-3 py-2.5 bg-gray-50 dark:bg-gray-700/70 border border-gray-200 dark:border-gray-600 text-gray-900 dark:text-white text-xs sm:text-sm rounded-xl focus:ring-2 focus:ring-blue-500">
                <option value="">Semua Metode</option>
                <option value="QRIS">QRIS</option>
                <option value="Tunai">Tunai</option>
                <option value="Transfer">Transfer / Debit</option>
            </select>
        </div>

        <!-- Tipe Pesanan Dropdown (2 Cols) -->
        <div class="lg:col-span-2">
            <select id="history-type-filter" onchange="applyHistoryFilters()"
                class="w-full px-3 py-2.5 bg-gray-50 dark:bg-gray-700/70 border border-gray-200 dark:border-gray-600 text-gray-900 dark:text-white text-xs sm:text-sm rounded-xl focus:ring-2 focus:ring-blue-500">
                <option value="">Semua Tipe</option>
                <option value="Dine In">Dine In (Makan Sini)</option>
                <option value="Take Away">Take Away (Bungkus)</option>
                <option value="Delivery">Delivery</option>
            </select>
        </div>

        <!-- Tanggal Picker (3 Cols) -->
        <div class="lg:col-span-3 flex items-center gap-2">
            <input type="date" id="history-date-filter" value="2026-08-22" onchange="applyHistoryFilters()"
                class="w-full px-3 py-2.5 bg-gray-50 dark:bg-gray-700/70 border border-gray-200 dark:border-gray-600 text-gray-900 dark:text-white text-xs sm:text-sm rounded-xl focus:ring-2 focus:ring-blue-500" />
            
            <button type="button" onclick="resetHistoryFilters()" title="Reset Filter"
                class="p-2.5 text-gray-500 hover:text-gray-700 dark:text-gray-400 dark:hover:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-700 rounded-xl transition cursor-pointer">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                </svg>
            </button>
        </div>

    </div>

</div>
