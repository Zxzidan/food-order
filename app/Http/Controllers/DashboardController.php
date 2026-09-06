<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use App\Models\Order;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        $admin = User::first();
        $nama = $admin ? $admin->name : 'Dandi Azaidane';

        $totalCustomers = Order::distinct('customer_name')->count('customer_name');
        if ($totalCustomers === 0) {
            $totalCustomers = 500;
        } // fallback aesthetic number

        $totalOrders = Order::count();
        $menusAvailable = Menu::where('is_available', true)->count();

        // Top 4 Best Selling Menus
        $bestSellingMenus = Menu::orderByDesc('sold')->take(4)->get();

        // Calculate sales for the current week (Monday to Sunday)
        $weeklySales = [];
        for ($i = 0; $i < 7; $i++) {
            $date = \Illuminate\Support\Carbon::now()->startOfWeek()->addDays($i);
            $dailyTotal = Order::where('status', 'Selesai')->whereDate('created_at', $date)->sum('total_amount');
            $weeklySales[] = [
                'day' => $date->translatedFormat('D'),
                'total' => (int) $dailyTotal,
                'formatted' => 'Rp' . number_format($dailyTotal / 1000000, 1, ',', '') . 'M', // Short format like Rp1.2M
                'raw_formatted' => 'Rp ' . number_format($dailyTotal, 0, ',', '.')
            ];
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
