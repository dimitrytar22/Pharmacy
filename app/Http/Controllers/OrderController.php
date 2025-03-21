<?php

namespace App\Http\Controllers;

use App\Http\Requests\OrderRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class OrderController extends Controller
{
    public function proceed(OrderRequest $request)
    {
        $data = $request->validated();
        return response()->json([
            'message' => $data
        ]);
    }
}
