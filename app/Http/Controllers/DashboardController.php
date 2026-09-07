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
        $nama = $admin ? $admin->name : 'Dandi Azaidane';

        try {
            $totalCustomers = Order::where('user_id', auth()->id())
                ->whereNotNull('customer_name')
                ->distinct('customer_name')
                ->count('customer_name');
        } catch (\Throwable) {
            $totalCustomers = 0;
        }

        $totalOrders = Order::where('user_id', auth()->id())->count();
        $menusAvailable = Menu::where('is_available', true)->count();

        // Top 5 Best Selling Menus from database
        $bestSellingMenus = Menu::with('category')->orderByDesc('sold')->take(5)->get();

        // Calculate sales for the current week (Monday to Sunday)
        $weeklySales = [];
        for ($i = 0; $i < 7; $i++) {
            $date = Carbon::now()->startOfWeek()->addDays($i);
            $dailyTotal = Order::where('user_id', auth()->id())->where('status', 'Selesai')->whereDate('created_at', $date)->sum('total_amount');
            $weeklySales[] = [
                'day' => $date->translatedFormat('D'),
                'total' => (int) $dailyTotal,
                'formatted' => 'Rp'.number_format($dailyTotal / 1000000, 1, ',', '').'M', // Short format like Rp1.2M
                'raw_formatted' => 'Rp '.number_format($dailyTotal, 0, ',', '.'),
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
