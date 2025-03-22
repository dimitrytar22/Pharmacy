<?php

namespace App\Http\Controllers;

use App\Http\Services\DiscountService;
use Illuminate\Http\Request;

class DiscountController extends Controller
{
    public function __construct(private DiscountService $service)
    {
    }
    public function check(Request $request)
    {
        return $this->service->check($request);
    }
}
