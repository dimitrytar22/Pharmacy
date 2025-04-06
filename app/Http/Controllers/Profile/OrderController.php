<?php

namespace App\Http\Controllers\Profile;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $orders = $user->orders;
        return view('profile.orders.index', compact('orders'));

    }

    public function show(Order $order)
    {
        return view('profile.orders.show', compact('order'));
    }
}
