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

        return view('dashboard', [
            'title' => 'Dashboard',
            'nama' => $nama,
            'totalCustomers' => $totalCustomers,
            'totalOrders' => $totalOrders,
            'menusAvailable' => $menusAvailable,
            'bestSellingMenus' => $bestSellingMenus,
        ]);
    }
}
