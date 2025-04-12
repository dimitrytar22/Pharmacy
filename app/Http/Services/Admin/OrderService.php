<?php

namespace App\Http\Services\Admin;

use App\Http\Requests\Admin\User\Order\StoreRequest;
use App\Http\Requests\Admin\User\Order\UpdateRequest;
use App\Models\Order;
use App\Models\OrderProducts;
use App\Models\Product;
use App\Models\User;
use Carbon\Carbon;

class OrderService
{

    public function update(UpdateRequest $request, Order $order)
    {

        $data = $request->validated();
        $productIdsWithAmount = [];
        $amountGreaterThanCount = false;
        foreach ($data['products'] as $product) {
            $amountGreaterThanCount = $this->checkAvailability($product);

            if ($amountGreaterThanCount)
                break;
            $productIdsWithAmount[$product['id']] = ['amount' => $product['amount']];
        }
        if ($amountGreaterThanCount) {
            return [
                'status' => false,
                'error' => [
                    'message' => 'You have selected more items than are available in stock.'
                ]
            ];
        }
        $order->products()->sync($productIdsWithAmount);
        $order->payment_method_id = $data['payment_method_id'] ?? null;
        $order->discount_id = $data['discount_id'] ?? null;
        $order->finished_at = isset($data['finished_at']) ? Carbon::createFromFormat('Y-m-d\TH:i', $data['finished_at']) : null;

        $order->save();
        return [
            'status' => true,
            'error' => null,
        ];
    }

    public function store(StoreRequest $request, User $user)
    {
        $data = $request->validated();
        $data['user_id'] = $user->id;
        $order = Order::query()->create($data);
        $productIdsWithAmount = [];
        $amountGreaterThanCount = false;
        foreach ($data['products'] as $product) {
            $amountGreaterThanCount = $this->checkAvailability($product);
            if ($amountGreaterThanCount)
                break;
            $productIdsWithAmount[$product['id']] = ['amount' => $product['amount']];
        }
        if ($amountGreaterThanCount) {
            return [
                'status' => false,
                'error' => [
                    'message' => 'You have selected more items than are available in stock.'
                ],
                'order' => null,
            ];
        }
        $order->products()->attach($productIdsWithAmount);
        return [
            'status' => true,
            'error' => null,
            'order' => [
                'id' => $order->id
            ],
        ];
    }

    private function checkAvailability(array $product): bool
    {
        return $product['amount'] > Product::query()->find($product['id'])->count;

    }

}
