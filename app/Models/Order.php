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

    public function products(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(Product::class, 'order_products');
    }

    public function totalSum($discountSize = null)
    {
        $products = $this->belongsToMany(Product::class, 'order_products');
        $sum = $products->pluck('price')->sum();
        if ($discountSize)
            $sum = $sum * ((100 - $discountSize) / 100);
        return $sum;
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
