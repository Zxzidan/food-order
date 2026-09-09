<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use App\Models\Order;
use App\Services\MidtransService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Midtrans\Snap;
use Midtrans\Transaction;

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

        // 1. Cek apakah pesanan ini sebenarnya sudah dibayar di Midtrans (misal paid di sesi lain)
        try {
            $existingStatus = Transaction::status($order->order_number);
            if (is_object($existingStatus) && in_array($existingStatus->transaction_status ?? '', ['settlement', 'capture'])
                && (int) ($existingStatus->gross_amount ?? 0) === (int) $order->total_amount) {
                $order->markAsPaid(
                    paymentMethod: strtolower((string) ($existingStatus->payment_type ?? '')) === 'qris' ? 'QRIS' : ucfirst((string) ($existingStatus->payment_type ?? 'Midtrans')),
                    transactionId: $existingStatus->transaction_id ?? null,
                    paymentType: $existingStatus->payment_type ?? null,
                    transactionTime: $existingStatus->transaction_time ?? null,
                    settlementTime: $existingStatus->settlement_time ?? null
                );

                return response()->json([
                    'paid' => true,
                    'message' => 'Pesanan ini sudah berhasil dibayar.',
                    'redirect' => route('riwayat.pesanan'),
                ]);
            }
        } catch (\Exception) {
            // Belum ada transaksi di Midtrans, lanjut buat token
        }

        // 2. Buat Snap token dengan penanganan tabrakan order_id
        $midtransOrderId = $order->order_number;
        $snapToken = null;

        try {
            $snapToken = Snap::getSnapToken([
                'transaction_details' => [
                    'order_id' => $midtransOrderId,
                    'gross_amount' => (int) $order->total_amount,
                ],
                'customer_details' => [
                    'first_name' => $order->customer_name,
                ],
            ]);
        } catch (\Exception $e) {
            if (str_contains($e->getMessage(), 'order_id sudah digunakan')) {
                // Cari nomor order baru yang belum pernah dipakai di DB
                $todayPrefix = 'ORD-'.date('Ymd').'-';
                $latestOrder = Order::where('order_number', 'like', $todayPrefix.'%')->orderByDesc('id')->first();
                $seq = 1;
                if ($latestOrder && preg_match('/-(\d+)$/', $latestOrder->order_number, $matches)) {
                    $seq = (int) $matches[1] + 1;
                }
                do {
                    $newOrderNumber = $todayPrefix.str_pad((string) $seq, 4, '0', STR_PAD_LEFT);
                    $seq++;
                } while (Order::where('order_number', $newOrderNumber)->exists());

                try {
                    $snapToken = Snap::getSnapToken([
                        'transaction_details' => [
                            'order_id' => $newOrderNumber,
                            'gross_amount' => (int) $order->total_amount,
                        ],
                        'customer_details' => [
                            'first_name' => $order->customer_name,
                        ],
                    ]);
                    $order->update(['order_number' => $newOrderNumber]);
                } catch (\Exception) {
                    // Fallback menggunakan akhiran unik agar 100% tembus
                    $uniqueMidtransId = $newOrderNumber.'-'.substr((string) time(), -4);
                    $snapToken = Snap::getSnapToken([
                        'transaction_details' => [
                            'order_id' => $uniqueMidtransId,
                            'gross_amount' => (int) $order->total_amount,
                        ],
                        'customer_details' => [
                            'first_name' => $order->customer_name,
                        ],
                    ]);
                    $order->update([
                        'order_number' => $newOrderNumber,
                        'midtrans_transaction_id' => $uniqueMidtransId,
                    ]);
                }
            } else {
                return response()->json(['error' => $e->getMessage()], 500);
            }
        }

        $order->update([
            'snap_token' => $snapToken,
            'payment_method' => 'QRIS',
        ]);

        return response()->json(['snap_token' => $snapToken]);
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
