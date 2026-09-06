<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class OrderHistoryController extends Controller
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

        $orders = Order::with('items')->latest()->get();

        return view('riwayat-pesanan', [
            'title' => 'Riwayat Pesanan',
            'orders' => $orders,
        ]);
    }
}
