<?php

namespace App\Http\Services\Admin;

use App\Http\Requests\Admin\User\Order\StoreRequest;
use App\Http\Requests\Admin\User\Order\UpdateRequest;
use App\Models\Discount;
use App\Models\Order;
use App\Models\OrderProducts;
use App\Models\PaymentMethod;
use App\Models\Product;
use App\Models\Status;
use App\Models\User;
use Carbon\Carbon;

class OrderService
{

    public function getFilterData()
    {
        return [
            'statuses' => Status::all(),
            'paymentMethods' => PaymentMethod::all(),
            'discounts' => Discount::all(),
        ];
    }
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

        $data['paid_at'] = isset($data['paid_at']) ? Carbon::createFromFormat('Y-m-d\TH:i', $data['paid_at']) : null;
        $order->update($data);

        return [
            'status' => true,
            'error' => null,
        ];
    }

    public function store(StoreRequest $request, User $user)
    {
        $data = $request->validated();
        $data['user_id'] = $user->id;
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
        $order = Order::query()->create($data);
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
