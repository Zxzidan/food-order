<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_number',
        'user_id',
        'customer_name',
        'order_type',
        'table_number',
        'subtotal',
        'tax',
        'discount',
        'total_amount',
        'payment_method',
        'payment_status',
        'cash_received',
        'change_amount',
        'status',
        'notes',
        'midtrans_transaction_id',
        'midtrans_status',
        'midtrans_payment_type',
        'midtrans_transaction_time',
        'midtrans_settlement_time',
        'snap_token',
    ];

    protected function casts(): array
    {
        return [
            'subtotal' => 'integer',
            'tax' => 'integer',
            'discount' => 'integer',
            'total_amount' => 'integer',
            'cash_received' => 'integer',
            'change_amount' => 'integer',
            'midtrans_transaction_time' => 'datetime',
            'midtrans_settlement_time' => 'datetime',
        ];
    }

    /**
     * Relasi ke kasir / user yang melayani
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Relasi ke detail item pesanan
     */
    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }

    /**
     * Accessor total rupiah
     */
    public function getFormattedTotalAttribute(): string
    {
        return 'Rp '.number_format($this->total_amount, 0, ',', '.');
    }

    /**
     * Accessor subtotal rupiah
     */
    public function getFormattedSubtotalAttribute(): string
    {
        return 'Rp '.number_format($this->subtotal, 0, ',', '.');
    }

    /**
     * Accessor tax rupiah
     */
    public function getFormattedTaxAttribute(): string
    {
        return 'Rp '.number_format($this->tax, 0, ',', '.');
    }

    /**
     * Accessor nomor order yang disingkat agar tabel terlihat rapi (misal: #ORD-045)
     */
    public function getShortOrderNumberAttribute(): string
    {
        if (empty($this->order_number)) {
            return '-';
        }

        // Jika nomor order berformat seperti #ORD-20260822-045, ambil bagian akhir (#ORD-045)
        if (preg_match('/-(\d+)$/', $this->order_number, $matches)) {
            return '#ORD-'.$matches[1];
        }

        return Str::limit($this->order_number, 10);
    }

    /**
     * Selesaikan pesanan & kurangi stok menu secara idempotent (hanya sekali)
     */
    public function markAsPaid(string $paymentMethod, ?string $transactionId = null, ?string $paymentType = null, $transactionTime = null, $settlementTime = null): void
    {
        if ($this->payment_status === 'paid' && $this->status === 'Selesai') {
            return;
        }

        DB::transaction(function () use ($paymentMethod, $transactionId, $paymentType, $transactionTime, $settlementTime) {
            $this->update([
                'payment_status' => 'paid',
                'status' => 'Selesai',
                'payment_method' => $paymentMethod,
                'midtrans_transaction_id' => $transactionId ?? $this->midtrans_transaction_id,
                'midtrans_payment_type' => $paymentType ?? $this->midtrans_payment_type,
                'midtrans_transaction_time' => $transactionTime ?? $this->midtrans_transaction_time,
                'midtrans_settlement_time' => $settlementTime ?? $this->midtrans_settlement_time,
                'midtrans_status' => 'settlement',
            ]);

            // Potong stok menu dan tambahkan jumlah terjual
            $this->loadMissing('items');
            foreach ($this->items as $item) {
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
        });
    }
}
