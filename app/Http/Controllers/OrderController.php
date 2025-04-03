<?php

namespace App\Http\Controllers;

use App\Http\Requests\OrderRequest;
use App\Http\Services\OrderService;

class OrderController extends Controller
{
    public function __construct(private OrderService $service) {}

    public function checkout(OrderRequest $request)
    {
        dd($request->validated());

        return response()->json([
            'id' => $this->service->store($request),
        ]);
    }
}
