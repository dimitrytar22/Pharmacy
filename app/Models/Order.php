<?php

namespace App\Models;

use App\Http\Filters\QueryFilter;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'payment_method_id',
        'discount_id',
        'paid_at',
        'status_id',
    ];

    public function products(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(Product::class, 'order_products')->withPivot('amount');
    }

    public function totalSum(int $discountSize = null)
    {
        $products = $this->products();
        $sum = 0;
        $products->get(['price', 'amount'])->each(function ($item) use (&$sum){
            $sum += $item->price * $item->amount;
        });
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

    public function paymentMethod()
    {
        return $this->belongsTo(PaymentMethod::class);
    }

    public function scopeFilter(Builder $builder, QueryFilter $filter)
    {
        return $filter->apply($builder);
    }
    public function status()
    {
        return $this->belongsTo(Status::class);
    }

}
