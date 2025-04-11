<?php

namespace App\Http\Services\Admin;

use App\Http\Requests\Admin\Order\UpdateRequest;
use App\Models\Order;
use Carbon\Carbon;

class OrderService
{

    public function update(UpdateRequest $request, Order $order)
    {

        $data = $request->validated();
        $productsWithAmount = [];
        foreach ($data['products'] as $product) {
            $productsWithAmount[$product['id']] = ['amount' => $product['amount']];
        }
        $order->products()->sync($productsWithAmount);
        $order->payment_method_id = $data['payment_method_id'] ?? null;
        $order->discount_id = $data['discount_id'] ?? null;
        $order->finished_at = isset($data['finished_at']) ? Carbon::createFromFormat('Y-m-d\TH:i', $data['finished_at']) : null;

        $order->save();
    }

}
