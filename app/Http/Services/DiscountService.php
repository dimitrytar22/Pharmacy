<?php

namespace App\Http\Services;

use App\Models\Discount;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class DiscountService
{
    public function check(Request $request): JsonResponse
    {
        $discountTitle = $request->json()->get('discount');
        $discount = Discount::query()->where('title', $discountTitle)->get()->first();
        return response()->json([
                'status' => (bool)$discount,
                'data' => $discount ? [
                    'discount' => [
                        'title' => $discount->title,
                        'size' => $discount->size,
                    ]
                ] : null,
                'error' => $discount ? null : [
                    'code' => 404,
                    'message' => 'Discount not found',
                ]
            ]
        );
    }
}
