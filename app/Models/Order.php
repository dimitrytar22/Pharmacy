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

    public function products()
    {
        return $this->belongsToMany(Product::class, 'order_products');
    }

    public function totalSum()
    {
        $products = $this->belongsToMany(Product::class, 'order_products');

        return $products->pluck('price')->sum();
    }

    public function paypalOrder()
    {
        return $this->hasOne(PayPalOrder::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function discount()
    {
        return $this->belongsTo(Discount::class);
    }
}
