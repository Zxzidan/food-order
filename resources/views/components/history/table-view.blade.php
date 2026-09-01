@props(['orders' => []])

<div id="history-table-container" class="bg-white dark:bg-gray-800 rounded-2xl border border-gray-100 dark:border-gray-700 shadow-2xs overflow-hidden">
    <div class="overflow-x-auto">
        <table class="w-full min-w-[1050px] text-xs text-left text-gray-600 dark:text-gray-300">
            <thead class="text-xs uppercase tracking-wider bg-gray-50/80 dark:bg-gray-700/50 text-gray-500 dark:text-gray-400 border-b border-gray-100 dark:border-gray-700 font-semibold">
                <tr>
                    <th scope="col" class="px-5 py-3.5 whitespace-nowrap text-center">No. Order & Waktu</th>
                    <th scope="col" class="px-5 py-3.5 whitespace-nowrap text-center">Pelanggan</th>
                    <th scope="col" class="px-5 py-3.5 whitespace-nowrap text-center">Tipe Pesanan</th>
                    <th scope="col" class="px-5 py-3.5 whitespace-nowrap text-center">No. Meja</th>
                    <th scope="col" class="px-5 py-3.5 whitespace-nowrap text-center">Detail Pesanan</th>
                    <th scope="col" class="px-5 py-3.5 whitespace-nowrap text-center">Metode Bayar</th>
                    <th scope="col" class="px-5 py-3.5 whitespace-nowrap text-center">Total Tagihan</th>
                    <th scope="col" class="px-5 py-3.5 whitespace-nowrap text-center">Status</th>
                    <th scope="col" class="px-5 py-3.5 whitespace-nowrap text-center">Aksi</th>
                </tr>
            </thead>
            <tbody id="history-table-body" class="divide-y divide-gray-100 dark:divide-gray-700 font-medium">
                
                @forelse($orders as $order)
                @php
                    $itemsSummary = $order->items->map(function($item) {
                        return "{$item->quantity}x {$item->menu_name}";
                    })->join(', ');
                    $totalItems = $order->items->sum('quantity');
                    $itemsJson = json_encode($order->items->map(function($item) {
                        return [
                            'name' => $item->menu_name,
                            'qty' => $item->quantity,
                            'price' => $item->price,
                        ];
                    }));
                @endphp
                <tr class="history-item-row hover:bg-gray-50/80 dark:hover:bg-gray-700/40 transition"
                    data-id="{{ $order->order_number }}" data-customer="{{ $order->customer_name }}" data-type="{{ $order->order_type }}" data-payment="{{ $order->payment_method }}" data-status="{{ $order->status }}">
                    <td class="px-5 py-4 whitespace-nowrap text-center">
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-lg text-xs font-mono font-bold bg-blue-50 dark:bg-blue-900/30 text-blue-700 dark:text-blue-300 border border-blue-100 dark:border-blue-800 tracking-wide shadow-2xs" title="No. Order Lengkap: {{ $order->order_number }}">
                            {{ $order->short_order_number }}
                        </span>
                        <span class="text-[11px] text-gray-400 flex items-center justify-center gap-1 mt-1 font-normal">
                            <svg class="w-3 h-3 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                            {{ $order->created_at->translatedFormat('d M Y, H:i') }}
                        </span>
                    </td>
                    <td class="px-5 py-4 whitespace-nowrap text-center">
                        <span class="font-semibold text-gray-800 dark:text-gray-200 block">{{ $order->customer_name }}</span>
                        <span class="text-[11px] text-gray-400">Kasir: {{ $order->user ? $order->user->name : 'Admin' }}</span>
                    </td>
                    <td class="px-5 py-4 whitespace-nowrap text-center">
                        @if($order->order_type === 'Dine In')
                        <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-semibold bg-blue-50 dark:bg-blue-900/30 text-blue-600 dark:text-blue-400">
                            Dine In
                        </span>
                        @else
                        <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-semibold bg-purple-50 dark:bg-purple-900/30 text-purple-600 dark:text-purple-400">
                            Take Away
                        </span>
                        @endif
                    </td>
                    <td class="px-5 py-4 whitespace-nowrap font-semibold text-gray-700 dark:text-gray-300 text-center">
                        @if($order->order_type === 'Dine In')
                            <span class="inline-flex items-center px-2 py-0.5 rounded-md bg-gray-100 dark:bg-gray-700/60 text-xs text-gray-800 dark:text-gray-200">
                                {{ $order->table_number ?? '-' }}
                            </span>
                        @else
                            <span class="text-gray-400 dark:text-gray-500 font-normal text-xs">-</span>
                        @endif
                    </td>
                    <td class="px-5 py-4 max-w-xs text-center">
                        <p class="truncate text-gray-700 dark:text-gray-300">{{ $itemsSummary ?: 'Item' }}</p>
                        <span class="text-[11px] text-gray-400">Total {{ $totalItems }} item</span>
                    </td>
                    <td class="px-5 py-4 whitespace-nowrap text-center">
                        <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-lg bg-gray-100 dark:bg-gray-700 text-gray-800 dark:text-gray-200 text-xs font-medium">
                            <span class="w-2 h-2 rounded-full {{ $order->payment_method === 'QRIS' ? 'bg-blue-500' : ($order->payment_method === 'Tunai' ? 'bg-emerald-500' : 'bg-purple-500') }}"></span> {{ $order->payment_method }}
                        </span>
                    </td>
                    <td class="px-5 py-4 whitespace-nowrap text-center">
                        <span class="font-bold text-gray-900 dark:text-white text-sm">{{ $order->formatted_total }}</span>
                        <span class="text-[11px] text-emerald-600 dark:text-emerald-400 block font-medium">{{ $order->payment_status }}</span>
                    </td>
                    <td class="px-5 py-4 whitespace-nowrap text-center">
                        @if($order->status === 'Selesai')
                        <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-full text-xs font-semibold bg-emerald-50 dark:bg-emerald-900/30 text-emerald-600 dark:text-emerald-400">
                            <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span> Selesai
                        </span>
                        @elseif($order->status === 'Diproses')
                        <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-full text-xs font-semibold bg-blue-50 dark:bg-blue-900/30 text-blue-600 dark:text-blue-400">
                            <span class="w-1.5 h-1.5 rounded-full bg-blue-500"></span> Diproses
                        </span>
                        @else
                        <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-full text-xs font-semibold bg-red-50 dark:bg-red-900/30 text-red-600 dark:text-red-400">
                            <span class="w-1.5 h-1.5 rounded-full bg-red-500"></span> Batal
                        </span>
                        @endif
                    </td>
                    <td class="px-5 py-4 whitespace-nowrap text-center">
                        <div class="flex items-center justify-center gap-1.5">
                            <button type="button" title="Lihat Struk" onclick="openHistoryReceiptModal('{{ $order->order_number }}', '{{ addslashes($order->customer_name) }}', '{{ $order->order_type === 'Dine In' ? 'Dine In (' . ($order->table_number ?? 'Meja -') . ')' : 'Take Away' }}', '{{ $order->payment_method }}', '{{ $order->created_at->translatedFormat('d M Y, H:i') }}', {{ $order->subtotal }}, {{ $order->tax }}, {{ $order->total_amount }}, {{ $itemsJson }})"
                                class="p-1.5 text-blue-600 dark:text-blue-400 hover:bg-blue-50 dark:hover:bg-blue-900/30 rounded-lg transition cursor-pointer">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                </svg>
                            </button>
                            <button type="button" title="Cetak Ulang" onclick="directPrintOrder('{{ $order->order_number }}')"
                                class="p-1.5 text-gray-500 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-700 rounded-lg transition cursor-pointer">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z" />
                                </svg>
                            </button>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="9" class="px-5 py-8 text-center text-gray-400">Belum ada riwayat transaksi</td>
                </tr>
                @endforelse

            </tbody>
        </table>
    </div>
</div>
