<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PayPalOrder extends Model
{
    use HasFactory;

    protected $table = "paypal_orders";

    public function order()
    {
        return $this->belongsTo(Order::class);
    }
}
