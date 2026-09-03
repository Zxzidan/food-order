@props(['orders' => []])

<div id="history-cards-container" class="hidden grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
    
    @forelse($orders as $order)
    @php
        $itemsJson = json_encode($order->items->map(function($item) {
            return [
                'name' => $item->menu_name,
                'qty' => $item->quantity,
                'price' => $item->price,
            ];
        }));
    @endphp
    <div class="bg-white dark:bg-gray-800 p-5 rounded-2xl border border-gray-100 dark:border-gray-700 shadow-2xs space-y-4 hover:shadow-md transition">
        <div class="flex items-start justify-between">
            <div>
                <span class="inline-flex items-center px-2 py-0.5 rounded-md text-xs font-mono font-bold bg-orange-50 dark:bg-orange-950/30 text-orange-700 dark:text-orange-300 border border-orange-100 dark:border-orange-800 tracking-wide" title="No. Order Lengkap: {{ $order->order_number }}">
                    {{ $order->short_order_number }}
                </span>
                <span class="text-xs text-gray-400 block mt-1">{{ $order->created_at->translatedFormat('d M Y, H:i') }}</span>
            </div>
            @if($order->status === 'Selesai')
            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-semibold bg-emerald-50 dark:bg-emerald-900/30 text-emerald-600 dark:text-emerald-400">
                Selesai
            </span>
            @elseif($order->status === 'Diproses')
            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-semibold bg-orange-50 dark:bg-orange-950/30 text-orange-600 dark:text-orange-400">
                Diproses
            </span>
            @else
            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-semibold bg-red-50 dark:bg-red-900/30 text-red-600 dark:text-red-400">
                Batal
            </span>
            @endif
        </div>
        <div class="py-2 border-y border-dashed border-gray-100 dark:border-gray-700 space-y-1 text-xs">
            <div class="flex justify-between">
                <span class="text-gray-500">Pelanggan:</span>
                <span class="font-semibold text-gray-800 dark:text-gray-200">{{ $order->customer_name }}</span>
            </div>
            <div class="flex justify-between">
                <span class="text-gray-500">Tipe:</span>
                <span class="font-medium {{ $order->order_type === 'Dine In' ? 'text-orange-600 dark:text-orange-400' : 'text-purple-600 dark:text-purple-400' }}">
                    {{ $order->order_type === 'Dine In' ? 'Dine In (' . ($order->table_number ?? 'Meja -') . ')' : 'Take Away' }}
                </span>
            </div>
            <div class="flex justify-between">
                <span class="text-gray-500">Metode:</span>
                <span class="font-medium">{{ $order->payment_method }}</span>
            </div>
        </div>
        <div class="text-xs text-gray-600 dark:text-gray-300">
            <p class="font-semibold mb-1">Item Pesanan:</p>
            @foreach($order->items as $item)
                <p>• {{ $item->quantity }}x {{ $item->menu_name }}</p>
            @endforeach
        </div>
        <div class="pt-2 border-t border-gray-100 dark:border-gray-700 flex items-center justify-between">
            <div>
                <span class="text-[11px] text-gray-400 block">Total Pembayaran</span>
                <span class="text-base font-bold text-gray-900 dark:text-white">{{ $order->formatted_total }}</span>
            </div>
            <button type="button" onclick="openHistoryReceiptModal('{{ $order->order_number }}', '{{ addslashes($order->customer_name) }}', '{{ $order->order_type === 'Dine In' ? 'Dine In (' . ($order->table_number ?? 'Meja -') . ')' : 'Take Away' }}', '{{ $order->payment_method }}', '{{ $order->created_at->translatedFormat('d M Y, H:i') }}', {{ $order->subtotal }}, {{ $order->tax }}, {{ $order->total_amount }}, {{ $itemsJson }})"
                class="px-3 py-1.5 text-xs font-semibold text-orange-600 dark:text-orange-400 bg-orange-50 dark:bg-orange-950/30 rounded-xl hover:bg-orange-100 transition cursor-pointer">
                Lihat Struk
            </button>
        </div>
    </div>
    @empty
    <div class="col-span-full text-center py-8 text-gray-400">Belum ada kartu riwayat transaksi</div>
    @endforelse

</div>
