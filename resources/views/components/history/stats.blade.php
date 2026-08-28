@props(['stats' => []])

@php
    $totalOrders = $stats['total_orders'] ?? 0;
    $completedOrders = $stats['completed_orders'] ?? 0;
    $completedPercentage = $stats['completed_percentage'] ?? 0;
    $pendingOrCancelled = $stats['pending_or_cancelled'] ?? 0;
    $totalRevenue = $stats['total_revenue'] ?? 0;
    $averageOrder = $stats['average_order'] ?? 0;
@endphp

<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
    
    <!-- Card 1: Total Transaksi Tercatat -->
    <div class="bg-white dark:bg-gray-800 p-4 sm:p-5 rounded-2xl border border-gray-100 dark:border-gray-700 shadow-2xs flex items-center justify-between">
        <div>
            <p class="text-xs font-medium text-gray-500 dark:text-gray-400">Total Transaksi</p>
            <h3 id="stat-total-orders" class="text-2xl font-bold text-gray-900 dark:text-white mt-1">{{ $totalOrders }} Pesanan</h3>
            <p class="text-[11px] text-gray-400 mt-1">Semua jenis pesanan</p>
        </div>
        <div class="p-3 bg-blue-50 dark:bg-blue-900/30 text-blue-600 dark:text-blue-400 rounded-2xl shrink-0">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
            </svg>
        </div>
    </div>

    <!-- Card 2: Pesanan Selesai -->
    <div class="bg-white dark:bg-gray-800 p-4 sm:p-5 rounded-2xl border border-gray-100 dark:border-gray-700 shadow-2xs flex items-center justify-between">
        <div>
            <p class="text-xs font-medium text-gray-500 dark:text-gray-400">Pesanan Selesai</p>
            <h3 id="stat-success-orders" class="text-2xl font-bold text-emerald-600 dark:text-emerald-400 mt-1">{{ $completedOrders }} ({{ $completedPercentage }}%)</h3>
            <p class="text-[11px] text-emerald-600/80 dark:text-emerald-400/80 mt-1">Berhasil dibayar & disajikan</p>
        </div>
        <div class="p-3 bg-emerald-50 dark:bg-emerald-900/30 text-emerald-600 dark:text-emerald-400 rounded-2xl shrink-0">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
        </div>
    </div>

    <!-- Card 3: Pesanan Diproses / Dibatalkan -->
    <div class="bg-white dark:bg-gray-800 p-4 sm:p-5 rounded-2xl border border-gray-100 dark:border-gray-700 shadow-2xs flex items-center justify-between">
        <div>
            <p class="text-xs font-medium text-gray-500 dark:text-gray-400">Proses / Dibatalkan</p>
            <h3 id="stat-pending-cancel" class="text-2xl font-bold text-amber-600 dark:text-amber-400 mt-1">{{ $pendingOrCancelled }}</h3>
            <p class="text-[11px] text-gray-400 mt-1">Antrean dapur / batal</p>
        </div>
        <div class="p-3 bg-amber-50 dark:bg-amber-900/30 text-amber-600 dark:text-amber-400 rounded-2xl shrink-0">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
        </div>
    </div>

    <!-- Card 4: Total Omzet -->
    <div class="bg-white dark:bg-gray-800 p-4 sm:p-5 rounded-2xl border border-gray-100 dark:border-gray-700 shadow-2xs flex items-center justify-between">
        <div>
            <p class="text-xs font-medium text-gray-500 dark:text-gray-400">Total Pemasukan</p>
            <h3 class="text-2xl font-bold text-gray-900 dark:text-white mt-1">Rp {{ number_format($totalRevenue, 0, ',', '.') }}</h3>
            <p class="text-[11px] text-blue-600 dark:text-blue-400 mt-1">Rata-rata: Rp {{ number_format($averageOrder, 0, ',', '.') }} / nota</p>
        </div>
        <div class="p-3 bg-purple-50 dark:bg-purple-900/30 text-purple-600 dark:text-purple-400 rounded-2xl shrink-0">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z" />
            </svg>
        </div>
    </div>

</div>
