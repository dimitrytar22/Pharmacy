<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class MainController extends Controller
{
    public function  index()
    {
        $categories = Category::all()->random(4);
        return view('main', compact('categories'));
    }
}
