<?php

namespace App\Http\Controllers;

use App\Http\Requests\Order\CaptureRequest;
use App\Http\Requests\Order\PayRequest;
use App\Http\Requests\OrderRequest;
use App\Http\Services\OrderService;
use App\Models\Order;

class OrderController extends Controller
{
    public function __construct(private OrderService $service)
    {
    }

    public function store(OrderRequest $request)
    {
        $order = $this->service->store($request);

        return redirect()->route('orders.checkout', $order->id);
    }

    public function checkout(Order $order)
    {
        return view('orders.checkout', compact('order'));
    }

    public function pay(PayRequest $request, Order $order)
    {
        $result = $this->service->pay($request, $order);
        if (!$result['status']) {
            return view('orders.payment-fail', compact('order'));
        }
        return redirect($result['payment_link']);
    }

    public function fail(Order $order)
    {
        return view('orders.payment-fail', compact('order'));
    }
    public function success(CaptureRequest $request, Order $order)
    {
        $result = $this->service->captureOrder($request, $order);
//        dd($result);
        return view('orders.payment-success', compact('order'));
    }
}
