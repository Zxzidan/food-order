@props(['orders' => []])

<div class="bg-white dark:bg-gray-800 rounded-2xl border border-gray-100 dark:border-gray-700 shadow-2xs overflow-hidden">
    
    <!-- Table Header Toolbar -->
    <div class="p-5 border-b border-gray-100 dark:border-gray-700 flex flex-col md:flex-row md:items-center justify-between gap-4">
        <div>
            <h2 class="text-base sm:text-lg font-bold text-gray-900 dark:text-white">Daftar Riwayat Transaksi</h2>
            <p class="text-xs text-gray-500 dark:text-gray-400">Rincian seluruh transaksi kasir yang masuk pada periode terpilih</p>
        </div>

        <!-- Table Filters -->
        <div class="flex flex-wrap items-center gap-2.5">
            <!-- Search Input -->
            <div class="relative min-w-[200px]">
                <input type="search" id="report-search-table" onkeyup="filterReportTable()"
                    placeholder=""
                    class="w-full pl-9 pr-3 py-2 bg-gray-50 dark:bg-gray-700/80 border border-gray-200 dark:border-gray-600 text-gray-900 dark:text-white text-xs rounded-xl focus:ring-2 focus:ring-blue-500" />
                <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none text-gray-400">
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m21 21-3.5-3.5M17 10a7 7 0 1 1-14 0 7 7 0 0 1 14 0Z" />
                    </svg>
                </div>
            </div>

            <!-- Payment Method Filter -->
            <select id="report-filter-payment" onchange="filterReportTable()"
                class="px-3 py-2 bg-gray-50 dark:bg-gray-700/80 border border-gray-200 dark:border-gray-600 text-gray-900 dark:text-white text-xs rounded-xl focus:ring-2 focus:ring-blue-500">
                <option value="">Semua Metode</option>
                <option value="QRIS">QRIS</option>
                <option value="Tunai">Tunai</option>
                <option value="Debit">Debit</option>
                <option value="Transfer">Transfer</option>
            </select>

            <!-- Order Type Filter -->
            <select id="report-filter-type" onchange="filterReportTable()"
                class="px-3 py-2 bg-gray-50 dark:bg-gray-700/80 border border-gray-200 dark:border-gray-600 text-gray-900 dark:text-white text-xs rounded-xl focus:ring-2 focus:ring-blue-500">
                <option value="">Semua Tipe</option>
                <option value="Dine In">Dine In</option>
                <option value="Take Away">Take Away</option>
            </select>
        </div>
    </div>

    <!-- Responsive Table -->
    <div class="overflow-x-auto">
        <table class="w-full text-xs text-left text-gray-600 dark:text-gray-300">
            <thead class="text-xs uppercase tracking-wider bg-gray-50/80 dark:bg-gray-700/50 text-gray-500 dark:text-gray-400 border-b border-gray-100 dark:border-gray-700 font-semibold">
                <tr>
                    <th scope="col" class="px-5 py-3.5">No. Order</th>
                    <th scope="col" class="px-5 py-3.5">Tanggal & Waktu</th>
                    <th scope="col" class="px-5 py-3.5">Pelanggan</th>
                    <th scope="col" class="px-5 py-3.5">Tipe Pesanan</th>
                    <th scope="col" class="px-5 py-3.5">No. Meja</th>
                    <th scope="col" class="px-5 py-3.5">Metode Bayar</th>
                    <th scope="col" class="px-5 py-3.5">Items</th>
                    <th scope="col" class="px-5 py-3.5 text-right">Total Transaksi</th>
                    <th scope="col" class="px-5 py-3.5 text-center">Status</th>
                    <th scope="col" class="px-5 py-3.5 text-center no-print">Aksi</th>
                </tr>
            </thead>
            <tbody id="report-table-body" class="divide-y divide-gray-100 dark:divide-gray-700 font-medium">
                
                @forelse($orders as $order)
                @php
                    $itemsSummary = $order->items->map(function($item) {
                        return "{$item->quantity}x {$item->menu_name}";
                    })->join(', ');
                    $itemsJson = json_encode($order->items->map(function($item) {
                        return [
                            'name' => $item->menu_name,
                            'qty' => $item->quantity,
                            'price' => $item->price,
                        ];
                    }));
                @endphp
                <tr class="hover:bg-gray-50/80 dark:hover:bg-gray-700/40 transition">
                    <td class="px-5 py-4 font-bold text-gray-900 dark:text-white">{{ $order->order_number }}</td>
                    <td class="px-5 py-4 text-gray-500 dark:text-gray-400">{{ $order->created_at->translatedFormat('d M Y, H:i') }}</td>
                    <td class="px-5 py-4 font-semibold text-gray-800 dark:text-gray-200">{{ $order->customer_name }}</td>
                    <td class="px-5 py-4">
                        @if($order->order_type === 'Dine In')
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-[11px] font-semibold bg-blue-50 dark:bg-blue-900/30 text-blue-600 dark:text-blue-400">
                            Dine In
                        </span>
                        @else
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-[11px] font-semibold bg-purple-50 dark:bg-purple-900/30 text-purple-600 dark:text-purple-400">
                            Take Away
                        </span>
                        @endif
                    </td>
                    <td class="px-5 py-4 font-semibold text-gray-700 dark:text-gray-300">
                        @if($order->order_type === 'Dine In')
                            <span class="inline-flex items-center px-2 py-0.5 rounded-md bg-gray-100 dark:bg-gray-700/60 text-[11px] text-gray-800 dark:text-gray-200">
                                {{ $order->table_number ?? '-' }}
                            </span>
                        @else
                            <span class="text-gray-400 dark:text-gray-500 font-normal">-</span>
                        @endif
                    </td>
                    <td class="px-5 py-4 font-medium">{{ $order->payment_method }}</td>
                    <td class="px-5 py-4 text-gray-500 truncate max-w-xs">{{ $itemsSummary ?: 'Item' }}</td>
                    <td class="px-5 py-4 text-right font-bold text-gray-900 dark:text-white">{{ $order->formatted_total }}</td>
                    <td class="px-5 py-4 text-center">
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-[11px] font-semibold bg-emerald-50 dark:bg-emerald-900/30 text-emerald-600 dark:text-emerald-400">
                            {{ $order->status }}
                        </span>
                    </td>
                    <td class="px-5 py-4 text-center no-print">
                        <button type="button" onclick="showReceiptDetail('{{ $order->order_number }}', '{{ addslashes($order->customer_name) }}', '{{ $order->order_type === 'Dine In' ? 'Dine In (' . ($order->table_number ?? 'Meja -') . ')' : 'Take Away' }}', '{{ $order->payment_method }}', '{{ $order->created_at->translatedFormat('d M Y, H:i') }}', {{ $order->subtotal }}, {{ $order->tax }}, {{ $order->total_amount }}, {{ $itemsJson }})"
                            class="inline-flex items-center gap-1 text-xs text-blue-600 dark:text-blue-400 hover:text-blue-800 font-semibold p-1.5 rounded-lg hover:bg-blue-50 dark:hover:bg-blue-900/30 transition cursor-pointer">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                            </svg>
                            Struk
                        </button>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="10" class="px-5 py-8 text-center text-gray-400">Belum ada data transaksi</td>
                </tr>
                @endforelse

            </tbody>
        </table>
    </div>

    <!-- Table Pagination & Footer Summary -->
    <div class="px-5 py-4 bg-gray-50/80 dark:bg-gray-700/50 border-t border-gray-100 dark:border-gray-700 flex flex-col sm:flex-row items-center justify-between gap-3 text-xs text-gray-500 dark:text-gray-400 no-print">
        <p>Total <span class="font-bold text-gray-800 dark:text-gray-200">{{ count($orders) }}</span> transaksi</p>
    </div>

</div>
