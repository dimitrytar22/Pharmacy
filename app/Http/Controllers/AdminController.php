<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;

class AdminController extends Controller
{
    public function index()
    {
        return view('admin.index', [
            'totalProducts' => Product::query()->count(),
            'totalCategories' => Category::query()->count(),
        ]);
    }
}
