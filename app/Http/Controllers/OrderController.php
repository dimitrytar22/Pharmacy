<?php

namespace App\Http\Controllers;

use App\Http\Requests\OrderRequest;
use App\Http\Services\OrderService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class OrderController extends Controller
{
    public function __construct(private OrderService $service)
    {
    }

    public function store(OrderRequest $request)
    {
        return response()->json([
            'id' => $this->service->store($request)
        ]);
    }
}
