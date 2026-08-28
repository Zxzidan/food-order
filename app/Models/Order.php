<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
        return 'Rp ' . number_format($this->total_amount, 0, ',', '.');
    }

    /**
     * Accessor subtotal rupiah
     */
    public function getFormattedSubtotalAttribute(): string
    {
        return 'Rp ' . number_format($this->subtotal, 0, ',', '.');
    }

    /**
     * Accessor tax rupiah
     */
    public function getFormattedTaxAttribute(): string
    {
        return 'Rp ' . number_format($this->tax, 0, ',', '.');
    }
}
