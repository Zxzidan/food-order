<?php

namespace App\Services;

use App\Models\Order;
use Illuminate\Support\Facades\Log;
use Midtrans\Config;
use Midtrans\Transaction;

class MidtransService
{
    /**
     * Inisialisasi konfigurasi Midtrans SDK
     */
    public static function initConfig(): void
    {
        Config::$serverKey = config('services.midtrans.server_key') ?? config('midtrans.server_key');
        Config::$clientKey = config('services.midtrans.client_key') ?? config('midtrans.client_key');
        Config::$isProduction = (bool) (config('services.midtrans.is_production') ?? config('midtrans.is_production') ?? false);
        Config::$isSanitized = true;
        Config::$is3ds = true;
        Config::$curlOptions = [
            CURLOPT_SSL_VERIFYHOST => 0,
            CURLOPT_SSL_VERIFYPEER => 0,
            CURLOPT_HTTPHEADER => [],
            CURLOPT_TIMEOUT => 5,
        ];
    }

    /**
     * Cek status transaksi ke API Midtrans dan perbarui data Order
     */
    public static function syncOrderStatus(Order $order): bool
    {
        if ($order->payment_status === 'paid' && $order->status === 'Selesai') {
            return true;
        }

        if (empty($order->order_number)) {
            return false;
        }

        self::initConfig();

        try {
            $status = Transaction::status($order->order_number);

            if (is_object($status)) {
                $transactionStatus = $status->transaction_status ?? null;
                $fraudStatus = $status->fraud_status ?? null;
                $paymentType = $status->payment_type ?? 'qris';

                if ($transactionStatus === 'settlement' || ($transactionStatus === 'capture' && $fraudStatus === 'accept')) {
                    $methodName = strtolower((string) $paymentType) === 'qris' ? 'QRIS' : ucfirst((string) $paymentType);
                    $order->markAsPaid(
                        paymentMethod: $methodName,
                        transactionId: $status->transaction_id ?? null,
                        paymentType: $paymentType,
                        transactionTime: $status->transaction_time ?? null,
                        settlementTime: $status->settlement_time ?? null
                    );

                    return true;
                } elseif (in_array($transactionStatus, ['deny', 'cancel', 'expire'])) {
                    $order->update([
                        'payment_status' => $transactionStatus === 'expire' ? 'expired' : 'cancelled',
                        'status' => 'Batal',
                        'midtrans_status' => $transactionStatus,
                    ]);
                }
            }
        } catch (\Exception $e) {
            // Log for debugging if not 404
            Log::info("Midtrans sync status for {$order->order_number}: {$e->getMessage()}");
        }

        return false;
    }
}
