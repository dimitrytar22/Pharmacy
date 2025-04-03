<?php

namespace App\Http\Controllers;

use App\Http\Requests\OrderRequest;
use App\Http\Services\OrderService;
use App\Models\Order;

class OrderController extends Controller
{
    public function __construct(private OrderService $service) {}

    public function store(OrderRequest $request)
    {
        $order = $this->service->store($request);

        return redirect()->route('orders.checkout', $order->id);
    }
    public function checkout(Order $order)
    {
        return view('orders.checkout', compact('order'));
    }
}
