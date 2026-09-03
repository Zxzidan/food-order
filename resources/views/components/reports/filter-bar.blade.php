<div id="report-filter-bar" class="bg-white dark:bg-gray-800 p-4 rounded-2xl border border-gray-100 dark:border-gray-700 shadow-2xs flex flex-col lg:flex-row items-stretch lg:items-center justify-between gap-4 no-print">
    <!-- Filter Period Pills -->
    <div class="flex items-center flex-wrap gap-1.5 bg-gray-100/80 dark:bg-gray-700/60 p-1 rounded-xl">
        <button type="button" onclick="setPeriodFilter('today', this)"
            class="period-filter-btn px-3 py-1.5 rounded-lg text-xs font-semibold text-gray-600 dark:text-gray-300 hover:text-gray-900 dark:hover:text-white transition cursor-pointer">
            Hari Ini
        </button>
        <button type="button" onclick="setPeriodFilter('7days', this)"
            class="period-filter-btn px-3 py-1.5 rounded-lg text-xs font-semibold text-gray-600 dark:text-gray-300 hover:text-gray-900 dark:hover:text-white transition cursor-pointer">
            7 Hari Terakhir
        </button>
        <button type="button" onclick="setPeriodFilter('month', this)"
            class="period-filter-btn px-3 py-1.5 rounded-lg text-xs font-semibold bg-white dark:bg-gray-800 text-orange-600 dark:text-orange-400 shadow-2xs transition cursor-pointer">
            Bulan Ini
        </button>
        <button type="button" onclick="setPeriodFilter('year', this)"
            class="period-filter-btn px-3 py-1.5 rounded-lg text-xs font-semibold text-gray-600 dark:text-gray-300 hover:text-gray-900 dark:hover:text-white transition cursor-pointer">
            Tahun Ini
        </button>
    </div>

    <!-- Custom Date Range Inputs -->
    <div class="flex items-center flex-wrap gap-2.5">
        <div class="flex items-center gap-2 text-xs text-gray-500 dark:text-gray-400">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
            </svg>
            <span>Rentang:</span>
        </div>
        <input type="date" id="date-start" value="2026-08-01" onchange="applyCustomDates()"
            class="px-3 py-1.5 bg-gray-50 dark:bg-gray-700/80 border border-gray-200 dark:border-gray-600 text-gray-900 dark:text-white text-xs rounded-xl focus:ring-2 focus:ring-orange-500 focus:border-orange-500" />
        <span class="text-xs text-gray-400">s/d</span>
        <input type="date" id="date-end" value="2026-08-22" onchange="applyCustomDates()"
            class="px-3 py-1.5 bg-gray-50 dark:bg-gray-700/80 border border-gray-200 dark:border-gray-600 text-gray-900 dark:text-white text-xs rounded-xl focus:ring-2 focus:ring-orange-500 focus:border-orange-500" />
        
        <!-- Refresh Button -->
        <button type="button" onclick="refreshReportData()" title="Segarkan Data"
            class="p-2 text-gray-500 hover:text-orange-600 dark:text-gray-400 dark:hover:text-orange-400 hover:bg-gray-100 dark:hover:bg-gray-700 rounded-xl transition cursor-pointer">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
            </svg>
        </button>
    </div>
</div>
