<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class ReportController extends Controller
{
    public function index()
    {
        // Auto-cancel orders older than 15 minutes that haven't been paid
        Order::where('status', 'Menunggu Pembayaran')
             ->where('created_at', '<', now()->subMinutes(15))
             ->update([
                 'status' => 'Batal',
                 'payment_status' => 'expired'
             ]);

        // "buat semua pesanan yang sukses dibayar hanya pada halaman report saja."
        // We fetch only 'Selesai' orders for the table.
        $orders = Order::with('items')->where('status', 'Selesai')->latest()->get();
        
        $totalRevenue = $orders->sum('total_amount');
        $totalTransactions = $orders->count();
        $totalItemsSold = OrderItem::whereHas('order', function ($query) {
            $query->where('status', 'Selesai');
        })->sum('quantity');
        $aov = $totalTransactions > 0 ? (int) round($totalRevenue / $totalTransactions) : 0;

        $kpi = [
            'total_revenue' => $totalRevenue,
            'total_transactions' => $totalTransactions,
            'total_items_sold' => $totalItemsSold,
            'aov' => $aov,
        ];

        $topSelling = Menu::with('category')->orderByDesc('sold')->take(5)->get();

        // 1. Revenue & Orders Trend Area Chart (Last 12 days)
        $trendDates = [];
        $trendRevenue = [];
        $trendOrders = [];
        
        for ($i = 11; $i >= 0; $i--) {
            $date = Carbon::today()->subDays($i);
            $trendDates[] = $date->translatedFormat('j M');
            
            $dayOrders = Order::where('status', 'Selesai')->whereDate('created_at', $date);
            $trendRevenue[] = (int) $dayOrders->sum('total_amount');
            $trendOrders[] = $dayOrders->count();
        }

        // 2. Payment Methods Donut Chart
        $paymentMethods = Order::where('status', 'Selesai')
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
            'total' => $totalTransactions
        ];

        // 3. Peak Operational Hours Bar Chart
        $peakHoursData = Order::where('status', 'Selesai')
            ->select(DB::raw('HOUR(created_at) as hour'), DB::raw('count(*) as total'))
            ->groupBy('hour')
            ->orderBy('hour')
            ->pluck('total', 'hour')
            ->toArray();
            
        $hoursLabels = [];
        $hoursSeries = [];
        // Show hours from 10:00 to 22:00 for example, or dynamically based on data
        // Let's generate a fixed range from 10 to 22 for restaurant consistency, or just the hours with data
        $startHour = 8;
        $endHour = 22;
        for ($h = $startHour; $h <= $endHour; $h++) {
            $hoursLabels[] = str_pad($h, 2, '0', STR_PAD_LEFT) . ':00';
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
            ]
        ];

        return view('reports', [
            'title' => 'Reports',
            'orders' => $orders,
            'kpi' => $kpi,
            'topSelling' => $topSelling,
            'chartsData' => $chartsData
        ]);
    }
}
