<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_id',
        'name',
        'description',
        'price',
        'stock',
        'sold',
        'image',
        'is_available',
    ];

    protected function casts(): array
    {
        return [
            'price' => 'integer',
            'stock' => 'integer',
            'sold' => 'integer',
            'is_available' => 'boolean',
        ];
    }

    /**
     * Relasi ke kategori menu
     */
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * Relasi ke item pesanan
     */
    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }

    /**
     * Accessor harga format Rupiah
     */
    public function getFormattedPriceAttribute(): string
    {
        return 'Rp '.number_format($this->price, 0, ',', '.');
    }

    /**
     * Accessor URL Gambar Menu (mendukung Base64 Data URL, external URL, dan file lokal)
     */
    public function getImageUrlAttribute(): string
    {
        if (empty($this->image)) {
            return 'https://images.unsplash.com/photo-1546069901-ba9599a7e63c?w=400';
        }

        if (str_starts_with($this->image, 'http') || str_starts_with($this->image, 'data:')) {
            return $this->image;
        }

        return asset($this->image);
    }
}
