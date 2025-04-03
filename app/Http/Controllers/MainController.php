<?php

namespace App\Http\Controllers;

use App\Http\Services\PayPalService;
use App\Models\Category;
use App\Models\Order;
use App\Models\PayPalOrder;

class MainController extends Controller
{
    public function __construct(public PayPalService $service)
    {
//        $order = $this->service->getOrder();
//        $payment_id = $order['id'];
//        dd($order = $this->service->createOrder('1'));
//        dd($this->service->captureOrder($order['id']));

    }

    public function index()
    {
        $categories = Category::query()->limit(4)->get();

        return view('main', compact('categories'));
    }
}
