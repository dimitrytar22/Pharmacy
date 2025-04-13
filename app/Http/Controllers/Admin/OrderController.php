<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Filters\OrderFilter;
use App\Http\Requests\Admin\User\Order\StoreRequest;
use App\Http\Requests\Admin\User\Order\UpdateRequest;
use App\Http\Services\Admin\OrderService;
use App\Models\Discount;
use App\Models\Order;
use App\Models\PaymentMethod;
use App\Models\Status;
use App\Models\User;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function __construct(public OrderService $service)
    {
    }

    /**
     * Display a listing of the resource.
     */
    public function index(OrderFilter $filter, User $user)
    {
        $orders = Order::filter($filter)->where('user_id', $user->id)->paginate(20);
        $filterData = $this->service->getFilterData();
        return view('admin.users.orders.index', array_merge(compact('orders', 'user'), $filterData));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(User $user)
    {
        $paymentMethods = PaymentMethod::all();
        $discounts = Discount::all();
        return view('admin.users.orders.create', compact('user', 'paymentMethods', 'discounts'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request, User $user)
    {
        $response = $this->service->store($request, $user);
        return $response['status']
            ? redirect()->route('admin.users.orders.index', $user->id)
                ->with('success', "Order {$response['order']['id']} updated successfully!")
            : redirect()->back()->with('error', $response['error']['message']);
    }

    /**
     * Display the specified resource.
     */
    public function show(Order $order)
    {
        return view('admin.orders.show', compact('order'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Order $order)
    {
        $paymentMethods = PaymentMethod::all();
        $discounts = Discount::all();
        $statuses = Status::all();
        return view('admin.orders.edit', compact('order', 'paymentMethods', 'discounts', 'statuses'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRequest $request, Order $order)
    {
        $response = $this->service->update($request, $order);
        return $response['status'] ? redirect()->route('admin.users.orders.index', $order->user->id)->with('success', "Order $order->id updated successfully!") : redirect()->back()->with('error', $response['error']['message']);
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
