<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class MainController extends Controller
{
    public function  index()
    {
        $categories = Category::query()->limit(4)->get();
        return view('main', compact('categories'));
    }
}
