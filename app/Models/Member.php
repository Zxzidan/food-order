<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Member extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'member_code',
        'name',
        'phone',
        'email',
        'points_balance',
        'total_spend',
        'status',
    ];

    protected function casts(): array
    {
        return [
            'points_balance' => 'integer',
            'total_spend' => 'integer',
        ];
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function orders(): HasMany
    {
        return $this->hasMany(Order::class);
    }

    public function pointLogs(): HasMany
    {
        return $this->hasMany(MemberPointLog::class)->orderByDesc('id');
    }

    public function getFormattedPointsAttribute(): string
    {
        return number_format($this->points_balance, 0, ',', '.').' Poin';
    }

    public function getFormattedPointsValueAttribute(): string
    {
        return 'Rp '.number_format($this->points_balance * 1000, 0, ',', '.');
    }

    public function getFormattedTotalSpendAttribute(): string
    {
        return 'Rp '.number_format($this->total_spend, 0, ',', '.');
    }

    /**
     * Tambah poin ke saldo member & catat ke ledger mutasi
     */
    public function addPoints(int $points, ?Order $order = null, string $description = 'Perolehan poin transaksi'): MemberPointLog
    {
        $this->increment('points_balance', $points);
        $this->refresh();

        return $this->pointLogs()->create([
            'order_id' => $order?->id,
            'type' => 'earn',
            'points' => $points,
            'balance_after' => $this->points_balance,
            'description' => $description,
        ]);
    }

    /**
     * Potong poin dari saldo member & catat ke ledger mutasi
     */
    public function deductPoints(int $points, ?Order $order = null, string $description = 'Penukaran poin transaksi'): MemberPointLog
    {
        $actualDeduct = min($this->points_balance, $points);
        $this->decrement('points_balance', $actualDeduct);
        $this->refresh();

        return $this->pointLogs()->create([
            'order_id' => $order?->id,
            'type' => 'redeem',
            'points' => -$actualDeduct,
            'balance_after' => $this->points_balance,
            'description' => $description,
        ]);
    }

    /**
     * Generate kode member unik berformat MBR-YYYYMM-XXXX
     */
    public static function generateUniqueCode(int $userId): string
    {
        $prefix = 'MBR-'.date('Ym').'-';
        $latest = static::where('user_id', $userId)
            ->where('member_code', 'like', $prefix.'%')
            ->orderByDesc('id')
            ->first();

        $seq = 1;
        if ($latest && preg_match('/-(\d+)$/', $latest->member_code, $matches)) {
            $seq = (int) $matches[1] + 1;
        }

        do {
            $code = $prefix.str_pad((string) $seq, 4, '0', STR_PAD_LEFT);
            $seq++;
        } while (static::where('member_code', $code)->exists());

        return $code;
    }
}
