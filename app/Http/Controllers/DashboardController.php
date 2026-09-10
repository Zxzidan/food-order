<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use App\Models\Order;
use Illuminate\Support\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $admin = auth()->user();
        $nama = $admin ? $admin->name : 'Admin';

        try {
            $totalCustomers = Order::where('user_id', auth()->id())
                ->whereNotNull('customer_name')
                ->distinct('customer_name')
                ->count('customer_name');
        } catch (\Throwable) {
            $totalCustomers = 0;
        }

        try {
            $totalOrders = Order::where('user_id', auth()->id())->count();
        } catch (\Throwable) {
            $totalOrders = 0;
        }

        try {
            $menusAvailable = Menu::where('user_id', auth()->id())
                ->where('is_available', true)
                ->count();
        } catch (\Throwable) {
            $menusAvailable = 0;
        }

        // Top 5 Best Selling Menus from database belonging to current user
        try {
            $bestSellingMenus = Menu::where('user_id', auth()->id())
                ->with('category')
                ->where('sold', '>', 0)
                ->orderByDesc('sold')
                ->take(5)
                ->get();
        } catch (\Throwable) {
            $bestSellingMenus = collect();
        }

        // Calculate sales for the current week (Monday to Sunday)
        $weeklySales = [];
        try {
            for ($i = 0; $i < 7; $i++) {
                $date = Carbon::now()->startOfWeek()->addDays($i);
                $dailyTotal = Order::where('user_id', auth()->id())
                    ->where('status', 'Selesai')
                    ->whereDate('created_at', $date)
                    ->sum('total_amount');

                $weeklySales[] = [
                    'day' => $date->translatedFormat('D'),
                    'total' => (int) $dailyTotal,
                    'formatted' => 'Rp'.number_format($dailyTotal / 1000000, 1, ',', '').'M', // Short format like Rp1.2M
                    'raw_formatted' => 'Rp '.number_format($dailyTotal, 0, ',', '.'),
                ];
            }
        } catch (\Throwable) {
            $weeklySales = [];
        }

        return view('dashboard', [
            'title' => 'Dashboard',
            'nama' => $nama,
            'totalCustomers' => $totalCustomers,
            'totalOrders' => $totalOrders,
            'menusAvailable' => $menusAvailable,
            'bestSellingMenus' => $bestSellingMenus,
            'weeklySales' => $weeklySales,
        ]);
    }
}
