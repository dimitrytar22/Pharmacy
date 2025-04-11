<?php

namespace App\Http\Services\Admin;

use App\Http\Requests\Admin\Order\UpdateRequest;
use App\Models\Order;
use App\Models\OrderProducts;
use App\Models\Product;
use Carbon\Carbon;

class OrderService
{

    public function update(UpdateRequest $request, Order $order)
    {

        $data = $request->validated();
        $productsWithAmount = [];
        $amountGreaterThanCount = false;
        foreach ($data['products'] as $product) {
            $orderProduct = OrderProducts::query()->where('order_id', $order->id)->where('product_id', $product['id'])->first();
            if (!$orderProduct)
                $amountGreaterThanCount = $product['amount'] > Product::query()->find($product['id'])->count;
            else
                $amountGreaterThanCount = $product['amount'] > $orderProduct->product->count;

            if ($amountGreaterThanCount)
                break;
            $productsWithAmount[$product['id']] = ['amount' => $product['amount']];
        }
        if ($amountGreaterThanCount) {
            return [
                'status' => false,
                'error' => [
                    'message' => 'You have selected more items than are available in stock.'
                ]
            ];
        }
        $order->products()->sync($productsWithAmount);
        $order->payment_method_id = $data['payment_method_id'] ?? null;
        $order->discount_id = $data['discount_id'] ?? null;
        $order->finished_at = isset($data['finished_at']) ? Carbon::createFromFormat('Y-m-d\TH:i', $data['finished_at']) : null;

        $order->save();
        return [
            'status' => true,
            'error' => null,
        ];
    }

}
