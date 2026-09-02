<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class MidtransNotificationController extends Controller
{
    public function handle(Request $request)
    {
        $payload = $request->all();
        
        $orderId = $payload['order_id'] ?? null;
        $statusCode = $payload['status_code'] ?? null;
        $grossAmount = $payload['gross_amount'] ?? null;
        $signatureKey = $payload['signature_key'] ?? null;
        $transactionStatus = $payload['transaction_status'] ?? null;
        $fraudStatus = $payload['fraud_status'] ?? null;
        
        // 1. Validasi keberadaan parameter penting
        if (!$orderId || !$statusCode || !$grossAmount || !$signatureKey) {
            Log::warning('Midtrans Notification: Payload tidak lengkap', ['payload' => $payload]);
            return response()->json(['message' => 'Invalid payload'], 400);
        }
        
        // 2. Validasi Signature
        $serverKey = config('services.midtrans.server_key') ?? config('midtrans.server_key');
        $calculatedSignature = hash('sha512', $orderId . $statusCode . $grossAmount . $serverKey);
        
        if ($calculatedSignature !== $signatureKey) {
            Log::warning("Midtrans Notification: Invalid signature for Order ID {$orderId}");
            return response()->json(['message' => 'Invalid signature'], 403);
        }
        
        // 3. Pencarian Order
        $order = Order::where('order_number', $orderId)->first();
        
        if (!$order) {
            Log::error("Midtrans Notification: Order ID {$orderId} tidak ditemukan di database.");
            return response()->json(['message' => 'Order not found'], 404);
        }

        // Idempotency: Jika pesanan sudah Selesai (karena dibayar Tunai, dsb)
        if ($order->status === 'Selesai' && $order->payment_method !== 'QRIS' && $order->payment_method !== null) {
            Log::info("Midtrans Notification: Order {$orderId} sudah diselesaikan dengan metode lain ({$order->payment_method}). Mengabaikan notifikasi.");
            return response()->json(['message' => 'Order already completed via another method'], 200);
        }

        // 4. Mapping Status
        $paymentStatus = 'pending';
        $orderStatus = $order->status; // default keep existing
        
        if ($transactionStatus == 'capture') {
            if ($fraudStatus == 'accept') {
                $paymentStatus = 'paid';
                $orderStatus = 'Diproses'; // Sesuai aturan: berubah menjadi Diproses setelah sukses
            }
        } elseif ($transactionStatus == 'settlement') {
            $paymentStatus = 'paid';
            $orderStatus = 'Diproses';
        } elseif ($transactionStatus == 'cancel' || $transactionStatus == 'deny' || $transactionStatus == 'expire') {
            $paymentStatus = $transactionStatus == 'deny' ? 'failed' : ($transactionStatus == 'expire' ? 'expired' : 'cancelled');
            $orderStatus = 'Dibatalkan'; // Opsional, bisa disesuaikan
        } elseif ($transactionStatus == 'pending') {
            $paymentStatus = 'pending';
        }

        // 5. Update Database
        $order->update([
            'payment_status' => $paymentStatus,
            'status' => $orderStatus,
            'midtrans_status' => $transactionStatus,
            'midtrans_transaction_id' => $payload['transaction_id'] ?? null,
            'midtrans_payment_type' => $payload['payment_type'] ?? null,
            'midtrans_transaction_time' => $payload['transaction_time'] ?? null,
            'midtrans_settlement_time' => $payload['settlement_time'] ?? null,
            'payment_method' => $payload['payment_type'] == 'qris' ? 'QRIS' : ($payload['payment_type'] ?? 'Midtrans'),
        ]);

        Log::info("Midtrans Notification: Berhasil memproses Order {$orderId}. Status: {$transactionStatus}, Payment Status: {$paymentStatus}");
        
        // 6. Return HTTP 200 OK
        return response()->json(['message' => 'Notification processed successfully']);
    }
}
