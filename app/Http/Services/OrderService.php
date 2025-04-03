<?php

namespace App\Http\Services;

use App\Http\Requests\OrderRequest;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;

class OrderService
{
    public function store(OrderRequest $request)
    {
        $data = $request->validated();
        $data['user_id'] = Auth::user()->id;
        if (! $data['discount_id']) {
            unset($data['discount_id']);
        }
        $order = Order::query()->create($data);

        return $order->id;
    }
}
