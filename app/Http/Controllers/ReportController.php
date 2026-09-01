<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use App\Models\Order;
use App\Models\OrderItem;

class ReportController extends Controller
{
    public function index()
    {
        $orders = Order::with('items')->latest()->get();
        $totalRevenue = $orders->where('status', 'Selesai')->sum('total_amount');
        $totalTransactions = $orders->count();
        $totalItemsSold = OrderItem::sum('quantity');
        $aov = $totalTransactions > 0 ? (int) round($totalRevenue / $totalTransactions) : 0;

        $kpi = [
            'total_revenue' => $totalRevenue,
            'total_transactions' => $totalTransactions,
            'total_items_sold' => $totalItemsSold,
            'aov' => $aov,
        ];

        $topSelling = Menu::with('category')->orderByDesc('sold')->take(5)->get();

        return view('reports', [
            'title' => 'Reports',
            'orders' => $orders,
            'kpi' => $kpi,
            'topSelling' => $topSelling,
        ]);
    }
}
