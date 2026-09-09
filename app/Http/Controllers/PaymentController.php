<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use App\Models\Order;
use App\Services\MidtransService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Midtrans\Snap;

class PaymentController extends Controller
{
    public function show($order_number)
    {
        $order = Order::where('user_id', auth()->id())->where('order_number', $order_number)->with('items')->firstOrFail();

        return view('checkout', [
            'title' => 'Pembayaran',
            'order' => $order,
        ]);
    }

    public function processCash(Request $request, $order_number)
    {
        if ($request->has('cash_received')) {
            $request->merge([
                'cash_received' => str_replace(['.', ','], '', (string) $request->cash_received),
            ]);
        }

        $validated = $request->validate([
            'cash_received' => 'required|numeric|min:0',
        ]);

        return DB::transaction(function () use ($validated, $order_number) {
            $order = Order::where('user_id', auth()->id())->where('order_number', $order_number)->with('items')->lockForUpdate()->firstOrFail();

            if ($order->payment_status === 'paid') {
                return redirect()->route('riwayat.pesanan')->with('error', 'Pesanan ini sudah dibayar.');
            }

            if ($validated['cash_received'] < $order->total_amount) {
                return back()->with('error', 'Uang yang diterima kurang dari total tagihan.');
            }

            $change = $validated['cash_received'] - $order->total_amount;

            // Update order with payment details
            $order->update([
                'payment_method' => 'Tunai',
                'payment_status' => 'paid',
                'cash_received' => $validated['cash_received'],
                'change_amount' => $change,
                'status' => 'Selesai',
            ]);

            // Decrement menu stock
            // In a more robust system, stock decrement might happen at order creation (reservation)
            // but the original logic decremented upon payment, let's keep it here for now as requested.
            // Wait, the prompt says "status = Diproses karena makanan masih harus diproses".
            // Let's keep the stock deduction here for cash payment.
            foreach ($order->items as $item) {
                if ($item->menu_id) {
                    $menu = Menu::find($item->menu_id);
                    if ($menu) {
                        $menu->decrement('stock', $item->quantity);
                        $menu->increment('sold', $item->quantity);
                        if ($menu->stock <= 0) {
                            $menu->update(['is_available' => false]);
                        }
                    }
                }
            }

            return redirect()->route('riwayat.pesanan')->with('success', 'Pembayaran berhasil diproses!');
        });
    }

    public function processMidtrans($order_number)
    {
        $order = Order::where('user_id', auth()->id())->where('order_number', $order_number)->firstOrFail();

        if ($order->payment_status === 'paid' || $order->status === 'Selesai') {
            return response()->json(['error' => 'Pesanan ini sudah dibayar.'], 400);
        }

        // Return existing token if already generated
        if ($order->snap_token) {
            return response()->json(['snap_token' => $order->snap_token]);
        }

        // Configure Midtrans
        MidtransService::initConfig();

        $params = [
            'transaction_details' => [
                'order_id' => $order->order_number,
                'gross_amount' => (int) $order->total_amount,
            ],
            'customer_details' => [
                'first_name' => $order->customer_name,
            ],
        ];

        try {
            $snapToken = Snap::getSnapToken($params);

            $order->update([
                'snap_token' => $snapToken,
                'payment_method' => 'QRIS',
            ]);

            return response()->json(['snap_token' => $snapToken]);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function callbackMidtrans($order_number)
    {
        $order = Order::where('user_id', auth()->id())->where('order_number', $order_number)->firstOrFail();

        $synced = MidtransService::syncOrderStatus($order);

        if ($synced) {
            return response()->json(['success' => true]);
        }

        return response()->json(['success' => false, 'message' => 'Status belum dibayar']);
    }
}
