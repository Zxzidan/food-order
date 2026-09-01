<?php

namespace App\Http\Controllers;

use App\Models\Order;

class HistoryController extends Controller
{
    public function index()
    {
        $orders = Order::with(['items.menu', 'user'])->latest()->get();

        $totalOrders = $orders->count();
        $completedOrders = $orders->where('status', 'Selesai')->count();
        $pendingOrCancelled = $orders->where('status', '!=', 'Selesai')->count();
        $totalRevenue = $orders->where('status', 'Selesai')->sum('total_amount');
        $averageOrder = $completedOrders > 0 ? (int) round($totalRevenue / $completedOrders) : 0;

        $stats = [
            'total_orders' => $totalOrders,
            'completed_orders' => $completedOrders,
            'completed_percentage' => $totalOrders > 0 ? round(($completedOrders / $totalOrders) * 100, 1) : 0,
            'pending_or_cancelled' => $pendingOrCancelled,
            'total_revenue' => $totalRevenue,
            'average_order' => $averageOrder,
        ];

        return view('history', [
            'title' => 'History',
            'orders' => $orders,
            'stats' => $stats,
        ]);
    }
}
