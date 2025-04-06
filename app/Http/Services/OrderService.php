<?php

namespace App\Http\Services;

use App\Http\Requests\Order\CaptureRequest;
use App\Http\Requests\Order\PayRequest;
use App\Http\Requests\OrderRequest;
use App\Models\Order;
use App\Models\PayPalOrder;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class OrderService
{
    public function __construct(public PayPalService $service)
    {
    }

    public function store(OrderRequest $request): Model
    {
        $data = $request->validated();
        $data['user_id'] = auth()->user()->id;
        $productIds = [];
        foreach ($data['products'] as $product) {
           $productIds[$product['id']] = ['amount' => $product['amount']];
        }
        unset($data['products']);
        $order = Order::query()->create($data);
        $order->products()->attach($productIds);
        return $order;
    }


    public function pay(PayRequest $request, Order $order): array
    {
        $data = $request->validated();
        $sum = $data['sum'];
        $orderExists = PayPalOrder::query()->where('order_id', $order->id)->first();
        if ($orderExists) {
            if ($orderExists->captured_at !== null) {
                return [
                    'status' => false
                ];
            }
            return [
                'status' => true,
                'paypal_order_id' => $orderExists->paypal_order_id,
                'payment_link' => $orderExists->payment_link,
            ];
        }
        $response = $this->service->createOrder($sum, $order->id);

        if (!$response['status'])
            return $response;
        $paypalOrderId = $response['id'];
        $paymentLink = $response['links'][1]['href'];

        PayPalOrder::query()->create([
            'order_id' => $order->id,
            'paypal_order_id' => $paypalOrderId,
            'payment_link' => $paymentLink,
        ]);

        return [
            'status' => true,
            'paypal_order_id' => $paypalOrderId,
            'payment_link' => $paymentLink
        ];


    }


    public function captureOrder(CaptureRequest $request, Order $order)
    {
        $data = $request->validated();
        $paypalOrderId = $data['token'];
        $response = $this->service->captureOrder($paypalOrderId);

        if ($response['message'] ?? null === 'RESOURCE_NOT_FOUND') {
            return false;
        }

        $paypalOrder = PayPalOrder::query()->where('paypal_order_id', $paypalOrderId)->first();
        $finishingDate = Carbon::parse($response['purchase_units'][0]['payments']['captures'][0]['create_time'])->format('Y-m-d H:i:s');
        $paypalOrder->captured_at = $finishingDate;
        $order = $paypalOrder->order;
        $order->finished_at = $finishingDate;
        $order->save();
        $paypalOrder->save();
        return true;
    }
}
