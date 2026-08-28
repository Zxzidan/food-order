@props(['kpi' => []])

@php
    $totalRevenue = $kpi['total_revenue'] ?? 0;
    $totalTransactions = $kpi['total_transactions'] ?? 0;
    $totalItemsSold = $kpi['total_items_sold'] ?? 0;
    $aov = $kpi['aov'] ?? 0;
@endphp

<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 sm:gap-5">
    
    <!-- KPI 1: Total Revenue -->
    <div class="bg-white dark:bg-gray-800 p-5 rounded-2xl border border-gray-100 dark:border-gray-700 shadow-2xs flex flex-col justify-between">
        <div class="flex items-start justify-between">
            <div>
                <p class="text-xs sm:text-sm font-medium text-gray-500 dark:text-gray-400">Total Pendapatan</p>
                <h3 id="stat-revenue" class="text-2xl sm:text-3xl font-bold text-gray-900 dark:text-white mt-1.5">Rp {{ number_format($totalRevenue, 0, ',', '.') }}</h3>
            </div>
            <div class="p-3 bg-emerald-50 dark:bg-emerald-900/30 text-emerald-600 dark:text-emerald-400 rounded-2xl shrink-0">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
            </div>
        </div>
        <div class="mt-4 pt-3 border-t border-gray-100 dark:border-gray-700/60 flex items-center justify-between text-xs">
            <span class="inline-flex items-center text-emerald-600 dark:text-emerald-400 font-semibold gap-1">
                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 10l7-7m0 0l7 7m-7-7v18"/>
                </svg>
                Realtime Data
            </span>
            <span class="text-gray-400 dark:text-gray-500">Database</span>
        </div>
    </div>

    <!-- KPI 2: Total Transactions -->
    <div class="bg-white dark:bg-gray-800 p-5 rounded-2xl border border-gray-100 dark:border-gray-700 shadow-2xs flex flex-col justify-between">
        <div class="flex items-start justify-between">
            <div>
                <p class="text-xs sm:text-sm font-medium text-gray-500 dark:text-gray-400">Total Transaksi</p>
                <h3 id="stat-transactions" class="text-2xl sm:text-3xl font-bold text-gray-900 dark:text-white mt-1.5">{{ number_format($totalTransactions) }}</h3>
            </div>
            <div class="p-3 bg-blue-50 dark:bg-blue-900/30 text-blue-600 dark:text-blue-400 rounded-2xl shrink-0">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01" />
                </svg>
            </div>
        </div>
        <div class="mt-4 pt-3 border-t border-gray-100 dark:border-gray-700/60 flex items-center justify-between text-xs">
            <span class="inline-flex items-center text-blue-600 dark:text-blue-400 font-semibold gap-1">
                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 10l7-7m0 0l7 7m-7-7v18"/>
                </svg>
                Terverifikasi
            </span>
            <span class="text-gray-400 dark:text-gray-500">POS System</span>
        </div>
    </div>

    <!-- KPI 3: Total Items Sold -->
    <div class="bg-white dark:bg-gray-800 p-5 rounded-2xl border border-gray-100 dark:border-gray-700 shadow-2xs flex flex-col justify-between">
        <div class="flex items-start justify-between">
            <div>
                <p class="text-xs sm:text-sm font-medium text-gray-500 dark:text-gray-400">Porsi Terjual</p>
                <h3 id="stat-items" class="text-2xl sm:text-3xl font-bold text-gray-900 dark:text-white mt-1.5">{{ number_format($totalItemsSold) }}</h3>
            </div>
            <div class="p-3 bg-amber-50 dark:bg-amber-900/30 text-amber-600 dark:text-amber-400 rounded-2xl shrink-0">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.042A8.967 8.967 0 0 0 6 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 0 1 6 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 0 1 6-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0 0 18 18a8.967 8.967 0 0 0-6 2.292m0-14.25v14.25" />
                </svg>
            </div>
        </div>
        <div class="mt-4 pt-3 border-t border-gray-100 dark:border-gray-700/60 flex items-center justify-between text-xs">
            <span class="inline-flex items-center text-emerald-600 dark:text-emerald-400 font-semibold gap-1">
                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 10l7-7m0 0l7 7m-7-7v18"/>
                </svg>
                Item Terdaftar
            </span>
            <span class="text-gray-400 dark:text-gray-500">Order Items</span>
        </div>
    </div>

    <!-- KPI 4: Average Order Value -->
    <div class="bg-white dark:bg-gray-800 p-5 rounded-2xl border border-gray-100 dark:border-gray-700 shadow-2xs flex flex-col justify-between">
        <div class="flex items-start justify-between">
            <div>
                <p class="text-xs sm:text-sm font-medium text-gray-500 dark:text-gray-400">Rata-rata Order (AOV)</p>
                <h3 id="stat-aov" class="text-2xl sm:text-3xl font-bold text-gray-900 dark:text-white mt-1.5">Rp {{ number_format($aov, 0, ',', '.') }}</h3>
            </div>
            <div class="p-3 bg-purple-50 dark:bg-purple-900/30 text-purple-600 dark:text-purple-400 rounded-2xl shrink-0">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6" />
                </svg>
            </div>
        </div>
        <div class="mt-4 pt-3 border-t border-gray-100 dark:border-gray-700/60 flex items-center justify-between text-xs">
            <span class="inline-flex items-center text-purple-600 dark:text-purple-400 font-semibold gap-1">
                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 10l7-7m0 0l7 7m-7-7v18"/>
                </svg>
                Per Transaksi
            </span>
            <span class="text-gray-400 dark:text-gray-500">Rata-rata</span>
        </div>
    </div>

</div>
