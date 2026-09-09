@props(['orders' => []])

<div class="bg-white dark:bg-gray-800 rounded-2xl border border-gray-100 dark:border-gray-700 shadow-2xs overflow-hidden">
    
    <!-- Header Toolbar -->
    <div class="p-5 border-b border-gray-100 dark:border-gray-700 flex flex-col sm:flex-row sm:items-center justify-between gap-4">
        <div class="flex-1">
            <!-- Empty space filled or can be used for title if needed in future -->
            <h3 class="text-sm font-semibold text-gray-700 dark:text-gray-300">Filter Transaksi:</h3>
        </div>
        <!-- Filters -->
        <div class="flex flex-wrap items-center gap-2.5">
            <!-- Search Input -->
            <div class="relative min-w-[200px]">
                <input type="search" id="report-search-table" onkeyup="filterReportTable()"
                    placeholder="Cari..."
                    class="w-full pl-9 pr-3 py-2 bg-gray-50 dark:bg-gray-700/80 border border-gray-200 dark:border-gray-600 text-gray-900 dark:text-white text-xs rounded-xl focus:ring-2 focus:ring-orange-500" />
                <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none text-gray-400">
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m21 21-3.5-3.5M17 10a7 7 0 1 1-14 0 7 7 0 0 1 14 0Z" />
                    </svg>
                </div>
            </div>

            <!-- Payment Method Filter -->
            <div class="relative">
                <select id="report-filter-payment" onchange="filterReportTable()"
                    class="appearance-none pl-3 pr-8 py-2 bg-gray-50 dark:bg-gray-700/80 border border-gray-200 dark:border-gray-600 text-gray-900 dark:text-white text-xs rounded-xl focus:ring-2 focus:ring-orange-500 cursor-pointer">
                    <option value="">Semua Metode</option>
                    <option value="QRIS">QRIS</option>
                    <option value="Tunai">Tunai</option>
                    <option value="Debit">Debit</option>
                    <option value="Transfer">Transfer</option>
                </select>
                <div class="absolute inset-y-0 right-0 flex items-center pr-2.5 pointer-events-none text-gray-400">
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 9-7 7-7-7" />
                    </svg>
                </div>
            </div>

            <!-- Order Type Filter -->
            <div class="relative">
                <select id="report-filter-type" onchange="filterReportTable()"
                    class="appearance-none pl-3 pr-8 py-2 bg-gray-50 dark:bg-gray-700/80 border border-gray-200 dark:border-gray-600 text-gray-900 dark:text-white text-xs rounded-xl focus:ring-2 focus:ring-orange-500 cursor-pointer">
                    <option value="">Semua Tipe</option>
                    <option value="Dine In">Dine In</option>
                    <option value="Take Away">Take Away</option>
                </select>
                <div class="absolute inset-y-0 right-0 flex items-center pr-2.5 pointer-events-none text-gray-400">
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 9-7 7-7-7" />
                    </svg>
                </div>
            </div>
        </div>
    </div>

    <!-- Responsive Cards Grid -->
    <div id="report-cards-container" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 p-6">
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
            
            // Define UI theme based on status
            $themeBorder = 'border-gray-200 dark:border-gray-700';
            $themeBgBadge = 'bg-gray-50 text-gray-700 border-gray-200';
            $themeBtn = 'bg-gray-50 text-gray-600 hover:bg-gray-100';
            
            if ($order->status === 'Selesai') {
                $themeBorder = 'border-emerald-200 dark:border-emerald-800 shadow-emerald-50 dark:shadow-none hover:border-emerald-400';
                $themeBgBadge = 'bg-emerald-50 dark:bg-emerald-950/30 text-emerald-700 dark:text-emerald-400 border-emerald-100 dark:border-emerald-800/50';
                $themeBtn = 'text-emerald-600 bg-emerald-50 hover:bg-emerald-100 dark:text-emerald-400 dark:bg-emerald-950/30 dark:hover:bg-emerald-900/50 border border-emerald-100 dark:border-emerald-800/30';
            } elseif ($order->status === 'Menunggu Pembayaran') {
                $themeBorder = 'border-yellow-200 dark:border-yellow-800/60 shadow-yellow-50 dark:shadow-none hover:border-yellow-400';
                $themeBgBadge = 'bg-yellow-50 dark:bg-yellow-950/30 text-yellow-700 dark:text-yellow-500 border-yellow-100 dark:border-yellow-800/50';
                $themeBtn = 'text-yellow-700 bg-yellow-50 hover:bg-yellow-100 dark:text-yellow-500 dark:bg-yellow-950/30 dark:hover:bg-yellow-900/50 border border-yellow-100 dark:border-yellow-800/30';
            } elseif ($order->status === 'Batal') {
                $themeBorder = 'border-gray-200 dark:border-gray-700 bg-gray-50/50 dark:bg-gray-800/30 hover:border-gray-300';
                $themeBgBadge = 'bg-gray-100 dark:bg-gray-800 text-gray-500 dark:text-gray-400 border-gray-200 dark:border-gray-700';
                $themeBtn = 'text-gray-500 bg-gray-100 hover:bg-gray-200 dark:text-gray-400 dark:bg-gray-800 dark:hover:bg-gray-700 border border-gray-200 dark:border-gray-700';
            } elseif ($order->status === 'Diproses') {
                $themeBorder = 'border-blue-200 dark:border-blue-800 shadow-blue-50 dark:shadow-none hover:border-blue-400';
                $themeBgBadge = 'bg-blue-50 dark:bg-blue-950/30 text-blue-700 dark:text-blue-400 border-blue-100 dark:border-blue-800/50';
                $themeBtn = 'text-blue-600 bg-blue-50 hover:bg-blue-100 dark:text-blue-400 dark:bg-blue-950/30 dark:hover:bg-blue-900/50 border border-blue-100 dark:border-blue-800/30';
            }
        @endphp
        
        <div class="report-item bg-white dark:bg-gray-800 border {{ $themeBorder }} rounded-2xl p-5 shadow-sm hover:shadow-md transition flex flex-col h-full" data-order="{{ $order->order_number }}">
            <!-- Header Card -->
            <div class="flex justify-between items-start mb-4">
                <div>
                    <span class="inline-flex items-center px-2.5 py-1 rounded-lg text-xs font-mono font-bold tracking-wide shadow-2xs {{ $themeBgBadge }}" title="No. Order Lengkap: {{ $order->order_number }}">
                        {{ $order->short_order_number }}
                    </span>
                    <p class="text-xs text-gray-500 dark:text-gray-400 mt-1.5 flex items-center gap-1.5 font-medium">
                        <svg class="w-3.5 h-3.5 text-gray-400 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        {{ $order->created_at->translatedFormat('d M Y, H:i') }}
                    </p>
                </div>
                <!-- Status Badge -->
                <div>
                    @if($order->status === 'Selesai')
                    <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-full text-xs font-semibold bg-emerald-50 dark:bg-emerald-900/30 text-emerald-600 dark:text-emerald-400">
                        <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span>
                        {{ $order->status }}
                    </span>
                    @elseif($order->status === 'Menunggu Pembayaran')
                    <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-full text-xs font-semibold bg-yellow-50 dark:bg-yellow-900/30 text-yellow-700 dark:text-yellow-500">
                        <span class="w-1.5 h-1.5 rounded-full bg-yellow-500"></span>
                        {{ $order->status }}
                    </span>
                    @elseif($order->status === 'Batal')
                    <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-full text-xs font-semibold bg-gray-100 dark:bg-gray-800 text-gray-500 dark:text-gray-400">
                        <span class="w-1.5 h-1.5 rounded-full bg-gray-400"></span>
                        {{ $order->status }}
                    </span>
                    @else
                    <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-full text-xs font-semibold bg-blue-50 dark:bg-blue-900/30 text-blue-700 dark:text-blue-400">
                        <span class="w-1.5 h-1.5 rounded-full bg-blue-400"></span>
                        {{ $order->status }}
                    </span>
                    @endif
                </div>
            </div>

            <!-- Tags (Type & Table) -->
            <div class="flex flex-wrap gap-2 mb-4">
                @if($order->order_type === 'Dine In')
                <span class="inline-flex items-center px-2.5 py-1 rounded-md text-xs font-semibold {{ $themeBgBadge }}">
                    Dine In
                </span>
                <span class="inline-flex items-center px-2.5 py-1 rounded-md text-xs font-semibold {{ $themeBgBadge }}">
                    {{ $order->table_number ?? '-' }}
                </span>
                @else
                <span class="inline-flex items-center px-2.5 py-1 rounded-md text-xs font-semibold {{ $themeBgBadge }}">
                    Take Away
                </span>
                @endif
            </div>

            <!-- Items Details -->
            <div class="flex-1 bg-gray-50/80 dark:bg-gray-700/40 border border-gray-100 dark:border-gray-600/50 rounded-xl p-3 mb-5 overflow-y-auto max-h-40">
                <p class="font-semibold text-gray-700 dark:text-gray-200 mb-2 text-xs uppercase tracking-wider">Detail Pesanan</p>
                <ul class="space-y-2 text-xs text-gray-600 dark:text-gray-300">
                    @foreach($order->items as $item)
                    <li class="flex justify-between items-start gap-2">
                        <span>{{ $item->quantity }}x <span class="font-medium text-gray-800 dark:text-gray-200">{{ $item->menu_name }}</span></span>
                        <span class="font-semibold">{{ 'Rp ' . number_format($item->subtotal, 0, ',', '.') }}</span>
                    </li>
                    @endforeach
                </ul>
            </div>

            <!-- Footer / Total & Actions -->
            <div class="pt-4 border-t border-gray-100 dark:border-gray-700 flex justify-between items-end mt-auto">
                <div>
                    <p class="text-[10px] text-gray-500 dark:text-gray-400 uppercase tracking-wider font-semibold mb-0.5">Total Transaksi</p>
                    <p class="font-bold text-gray-900 dark:text-white text-lg">{{ $order->formatted_total }}</p>
                </div>
                <div class="flex gap-2">
                    @if($order->status === 'Menunggu Pembayaran')
                    @if($order->snap_token)
                    <button type="button" onclick="checkOrderStatus('{{ $order->order_number }}', this)"
                        class="inline-flex items-center justify-center gap-1.5 text-xs text-orange-600 bg-orange-50 hover:bg-orange-100 dark:text-orange-400 dark:bg-orange-950/30 font-semibold px-3 py-2 rounded-xl shadow-xs transition cursor-pointer border border-orange-200 dark:border-orange-800/40" title="Periksa status pembayaran Midtrans">
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                        </svg>
                        Cek Status
                    </button>
                    @endif
                    <a href="{{ route('payment.show', $order->order_number) }}"
                        class="inline-flex items-center justify-center gap-1.5 text-xs text-white bg-blue-600 hover:bg-blue-700 font-semibold px-3 py-2 rounded-xl shadow-sm transition cursor-pointer">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"></path>
                        </svg>
                        Bayar
                    </a>
                    @endif
                    <button type="button" onclick="showReceiptDetail('{{ $order->order_number }}', '{{ addslashes($order->customer_name) }}', '{{ $order->order_type === 'Dine In' ? 'Dine In (' . ($order->table_number ?? 'Meja -') . ')' : 'Take Away' }}', '{{ $order->payment_method }}', '{{ $order->created_at->translatedFormat('d M Y, H:i') }}', {{ $order->subtotal }}, {{ $order->tax }}, {{ $order->total_amount }}, {{ $itemsJson }})"
                        class="inline-flex items-center justify-center gap-1.5 text-xs font-semibold px-3 py-2 rounded-xl transition cursor-pointer {{ $themeBtn }}">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                        </svg>
                        Struk
                    </button>
                </div>
            </div>
        </div>
        @empty
        <div class="col-span-full flex flex-col items-center justify-center py-12 text-gray-400 bg-gray-50/50 dark:bg-gray-800/30 rounded-2xl border border-dashed border-gray-200 dark:border-gray-700">
            <svg class="w-12 h-12 mb-3 text-gray-300 dark:text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"></path></svg>
            <p>Belum ada data transaksi</p>
        </div>
        @endforelse
    </div>

    <!-- Pagination & Footer Summary -->
    <div class="px-5 py-4 bg-gray-50/80 dark:bg-gray-700/50 border-t border-gray-100 dark:border-gray-700 flex flex-col sm:flex-row items-center justify-between gap-3 text-xs text-gray-500 dark:text-gray-400 no-print">
        <p>Total <span class="font-bold text-gray-800 dark:text-gray-200">{{ count($orders) }}</span> transaksi</p>
    </div>

</div>

<script>
    if (typeof checkOrderStatus !== 'function') {
        function checkOrderStatus(orderNumber, btn) {
            const originalContent = btn.innerHTML;
            btn.innerHTML = `<svg class="w-3.5 h-3.5 animate-spin inline-block mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" /></svg> Cek...`;
            btn.disabled = true;

            fetch(`/order/${orderNumber}/sync-status`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                }
            })
            .then(res => res.json())
            .then(data => {
                if (data.success) {
                    alert(data.message || 'Pembayaran berhasil dikonfirmasi!');
                    window.location.reload();
                } else {
                    alert(data.message || 'Pembayaran belum terdeteksi. Silakan selesaikan pembayaran.');
                    btn.innerHTML = originalContent;
                    btn.disabled = false;
                }
            })
            .catch(err => {
                console.error(err);
                alert('Terjadi kesalahan saat memeriksa status.');
                btn.innerHTML = originalContent;
                btn.disabled = false;
            });
        }
    }
</script>
