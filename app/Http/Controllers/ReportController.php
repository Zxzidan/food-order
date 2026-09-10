<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use App\Models\Order;
use App\Models\OrderItem;
use App\Services\MidtransService;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class ReportController extends Controller
{
    public function index()
    {
        // Auto-sync pesanan pending yang memiliki snap_token ke Midtrans
        $pendingOrders = Order::where('user_id', auth()->id())
            ->where('status', 'Menunggu Pembayaran')
            ->whereNotNull('snap_token')
            ->where('created_at', '>=', now()->subHours(24))
            ->get();

        foreach ($pendingOrders as $pendingOrder) {
            MidtransService::syncOrderStatus($pendingOrder);
        }

        // Auto-cancel orders older than 15 minutes that haven't been paid
        Order::where('user_id', auth()->id())
            ->where('status', 'Menunggu Pembayaran')
            ->where('created_at', '<', now()->subMinutes(15))
            ->update([
                'status' => 'Batal',
                'payment_status' => 'expired',
            ]);

        // "buat semua pesanan yang sukses dibayar hanya pada halaman report saja."
        // We fetch only 'Selesai' orders for the table.
        $orders = Order::where('user_id', auth()->id())->with('items')->where('status', 'Selesai')->latest()->get();

        $totalRevenue = $orders->sum('total_amount');
        $totalTransactions = $orders->count();
        $totalItemsSold = OrderItem::whereHas('order', function ($query) {
            $query->where('user_id', auth()->id())->where('status', 'Selesai');
        })->sum('quantity');
        $aov = $totalTransactions > 0 ? (int) round($totalRevenue / $totalTransactions) : 0;

        $kpi = [
            'total_revenue' => $totalRevenue,
            'total_transactions' => $totalTransactions,
            'total_items_sold' => $totalItemsSold,
            'aov' => $aov,
        ];

        $topSelling = Menu::where('user_id', auth()->id())->where('sold', '>', 0)->with('category')->orderByDesc('sold')->take(5)->get();

        // 1. Revenue & Orders Trend Area Chart (Last 12 days)
        $trendDates = [];
        $trendRevenue = [];
        $trendOrders = [];

        for ($i = 11; $i >= 0; $i--) {
            $date = Carbon::today()->subDays($i);
            $trendDates[] = $date->translatedFormat('j M');

            $dayOrders = Order::where('user_id', auth()->id())->where('status', 'Selesai')->whereDate('created_at', $date);
            $trendRevenue[] = (int) $dayOrders->sum('total_amount');
            $trendOrders[] = $dayOrders->count();
        }

        // 2. Payment Methods Donut Chart
        $paymentMethods = Order::where('user_id', auth()->id())->where('status', 'Selesai')
            ->select('payment_method', DB::raw('count(*) as total'))
            ->groupBy('payment_method')
            ->pluck('total', 'payment_method')
            ->toArray();

        $qrisCount = $paymentMethods['QRIS'] ?? 0;
        $tunaiCount = $paymentMethods['Tunai'] ?? 0;
        $transferCount = ($paymentMethods['Transfer'] ?? 0) + ($paymentMethods['Midtrans'] ?? 0);

        $paymentChart = [
            'labels' => ['QRIS', 'Tunai', 'Transfer / Lainnya'],
            'series' => [$qrisCount, $tunaiCount, $transferCount],
            'total' => $totalTransactions,
        ];

        // 3. Peak Operational Hours Bar Chart
        $hourExpression = match (DB::connection()->getDriverName()) {
            'pgsql' => 'EXTRACT(HOUR FROM created_at)::integer',
            'sqlite' => "CAST(strftime('%H', created_at) AS INTEGER)",
            default => 'HOUR(created_at)',
        };

        try {
            $peakHoursData = Order::where('user_id', auth()->id())->where('status', 'Selesai')
                ->select(DB::raw("{$hourExpression} as hour"), DB::raw('count(*) as total'))
                ->groupBy(DB::raw($hourExpression))
                ->orderBy('hour')
                ->pluck('total', 'hour')
                ->toArray();
        } catch (\Throwable) {
            $peakHoursData = [];
        }

        $hoursLabels = [];
        $hoursSeries = [];
        // Show hours from 10:00 to 22:00 for example, or dynamically based on data
        // Let's generate a fixed range from 10 to 22 for restaurant consistency, or just the hours with data
        $startHour = 8;
        $endHour = 22;
        for ($h = $startHour; $h <= $endHour; $h++) {
            $hoursLabels[] = str_pad($h, 2, '0', STR_PAD_LEFT).':00';
            $hoursSeries[] = $peakHoursData[$h] ?? 0;
        }

        $chartsData = [
            'trend' => [
                'categories' => $trendDates,
                'revenue' => $trendRevenue,
                'orders' => $trendOrders,
            ],
            'payment' => $paymentChart,
            'peak' => [
                'categories' => $hoursLabels,
                'data' => $hoursSeries,
            ],
        ];

        return view('reports', [
            'title' => 'Reports',
            'orders' => $orders,
            'kpi' => $kpi,
            'topSelling' => $topSelling,
            'chartsData' => $chartsData,
        ]);
    }

    /**
     * Ekspor data riwayat transaksi penjualan ke format CSV (Kompatibel Excel)
     */
    public function exportCsv(Request $request)
    {
        $query = Order::where('user_id', auth()->id())
            ->with('items')
            ->where(function ($q) {
                $q->where('status', 'Selesai')
                    ->orWhere('payment_status', 'paid');
            });

        if ($request->filled('start_date')) {
            $query->whereDate('created_at', '>=', $request->input('start_date'));
        }

        if ($request->filled('end_date')) {
            $query->whereDate('created_at', '<=', $request->input('end_date'));
        }

        if ($request->filled('payment_method')) {
            $query->where('payment_method', $request->input('payment_method'));
        }

        if ($request->filled('order_type')) {
            $query->where('order_type', $request->input('order_type'));
        }

        $orders = $query->latest()->get();

        $fileName = 'Laporan_Penjualan_SIPEMMA_'.now()->format('Y-m-d_His').'.csv';

        return response()->streamDownload(function () use ($orders) {
            $file = fopen('php://output', 'w');

            // UTF-8 BOM untuk kompatibilitas penuh Microsoft Excel di Windows
            fprintf($file, chr(0xEF).chr(0xBB).chr(0xBF));

            // Header Kolom CSV
            fputcsv($file, [
                'No. Pesanan',
                'Tanggal & Waktu',
                'Nama Pelanggan',
                'Tipe Pesanan',
                'Nomor Meja',
                'Metode Pembayaran',
                'Status Pembayaran',
                'Status Pesanan',
                'Daftar Menu',
                'Total Porsi Terjual',
                'Subtotal (Rp)',
                'Pajak PB1 10% (Rp)',
                'Total Pendapatan (Rp)',
            ]);

            foreach ($orders as $order) {
                $itemsList = $order->items->map(function ($item) {
                    return "{$item->quantity}x {$item->menu_name}";
                })->join(', ');

                $totalQty = $order->items->sum('quantity');

                fputcsv($file, [
                    $order->order_number,
                    $order->created_at ? $order->created_at->translatedFormat('d/m/Y H:i') : '-',
                    $order->customer_name ?: 'Umum',
                    $order->order_type,
                    $order->table_number ?: '-',
                    $order->payment_method ?: '-',
                    $order->payment_status === 'paid' ? 'Lunas' : $order->payment_status,
                    $order->status,
                    $itemsList,
                    $totalQty,
                    $order->subtotal,
                    $order->tax,
                    $order->total_amount,
                ]);
            }

            fclose($file);
        }, $fileName, [
            'Content-Type' => 'text/csv; charset=UTF-8',
            'Cache-Control' => 'no-cache, no-store, must-revalidate',
            'Pragma' => 'no-cache',
            'Expires' => '0',
        ]);
    }
}
