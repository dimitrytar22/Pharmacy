<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Order\UpdateRequest;
use App\Http\Requests\Admin\Product\SearchRequest;
use App\Http\Resources\Admin\ProductResource;
use App\Http\Services\Admin\OrderService;
use App\Models\Discount;
use App\Models\Order;
use App\Models\PaymentMethod;
use App\Models\Product;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function __construct(public OrderService $service)
    {
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $orders = Order::query()->paginate(20);
        return view('admin.orders.index', compact('orders'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Order $order)
    {
        $paymentMethods = PaymentMethod::all();
        $discounts = Discount::all();
        return view('admin.orders.edit', compact('order', 'paymentMethods', 'discounts'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRequest $request, Order $order)
    {
        $this->service->update($request, $order);
        return redirect()->route('admin.orders.index')->with('success', "Order $order->id updated successfully!");
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
