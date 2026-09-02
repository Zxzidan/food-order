<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PaymentController extends Controller
{
    public function show($order_number)
    {
        $order = Order::where('order_number', $order_number)->with('items')->firstOrFail();

        return view('checkout', [
            'title' => 'Pembayaran',
            'order' => $order,
        ]);
    }

    public function processCash(Request $request, $order_number)
    {
        $validated = $request->validate([
            'cash_received' => 'required|numeric|min:0',
        ]);

        return DB::transaction(function () use ($validated, $order_number) {
            $order = Order::where('order_number', $order_number)->with('items')->lockForUpdate()->firstOrFail();

            if ($order->payment_status === 'paid') {
                return redirect()->route('history.index')->with('error', 'Pesanan ini sudah dibayar.');
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
                'status' => 'Diproses', // According to requirements
            ]);

            // Decrement menu stock
            // In a more robust system, stock decrement might happen at order creation (reservation) 
            // but the original logic decremented upon payment, let's keep it here for now as requested.
            // Wait, the prompt says "status = Diproses karena makanan masih harus diproses".
            // Let's keep the stock deduction here for cash payment.
            foreach ($order->items as $item) {
                if ($item->menu_id) {
                    $menu = \App\Models\Menu::find($item->menu_id);
                    if ($menu) {
                        $menu->decrement('stock', $item->quantity);
                        $menu->increment('sold', $item->quantity);
                        if ($menu->stock <= 0) {
                            $menu->update(['is_available' => false]);
                        }
                    }
                }
            }

            return redirect()->route('history.index')->with('success', 'Pembayaran berhasil diproses!');
        });
    }
}
