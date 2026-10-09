<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_id',
        'name',
        'slug',
        'description',
        'price',
        'stock',
        'image',
    ];

    // ===== Relationships =====
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    // ===== Local Scopes =====
    public function scopeInStock($query)
    {
        return $query->where('stock', '>', 0);
    }

    public function scopeCheaperThan($query, $price)
    {
        return $query->where('price', '<', $price);
    }
}