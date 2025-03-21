<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'payment_method',
        'discount_id',
    ];
    public function items()
    {
        return $this->belongsToMany(Product::class, 'order_products');
    }

    public function totalSum()
    {
        $products = $this->belongsToMany(Product::class, 'order_products');
        return $products->pluck('price')->sum();
    }
}
