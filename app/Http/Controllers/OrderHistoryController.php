<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Services\MidtransService;

class OrderHistoryController extends Controller
{
    public function index()
    {
        // 1. Auto-sync pesanan pending yang memiliki snap_token ke Midtrans
        $pendingOrders = Order::where('user_id', auth()->id())
            ->where('status', 'Menunggu Pembayaran')
            ->whereNotNull('snap_token')
            ->where('created_at', '>=', now()->subHours(24))
            ->get();

        foreach ($pendingOrders as $pendingOrder) {
            MidtransService::syncOrderStatus($pendingOrder);
        }

        // 2. Auto-cancel orders older than 15 minutes that haven't been paid for this user
        Order::where('user_id', auth()->id())
            ->where('status', 'Menunggu Pembayaran')
            ->where('created_at', '<', now()->subMinutes(15))
            ->update([
                'status' => 'Batal',
                'payment_status' => 'expired',
            ]);

        $orders = Order::where('user_id', auth()->id())->with('items')->latest()->get();

        return view('riwayat-pesanan', [
            'title' => 'Riwayat Pesanan',
            'orders' => $orders,
        ]);
    }

    public function syncStatus($order_number)
    {
        $order = Order::where('user_id', auth()->id())
            ->where('order_number', $order_number)
            ->firstOrFail();

        $synced = MidtransService::syncOrderStatus($order);
        $order->refresh();

        return response()->json([
            'success' => $synced,
            'status' => $order->status,
            'payment_status' => $order->payment_status,
            'message' => $synced ? 'Status pesanan berhasil diperbarui menjadi Lunas!' : 'Pembayaran belum terverifikasi oleh Midtrans.',
        ]);
    }
}
