<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreProductRequest;
use App\Http\Requests\Admin\UpdateProductRequest;
use App\Http\Services\ProductService;
use App\Models\Category;
use App\Models\Product;

class ProductController extends Controller
{
    public function __construct(public ProductService $service) {}

    public function index()
    {
        $products = Product::query()->paginate(10);

        return view('admin.products.index', compact('products'));
    }

    public function create()
    {
        $categories = Category::all();

        return view('admin.products.create', compact('categories'));
    }

    public function store(StoreProductRequest $request)
    {
        $product = $this->service->store($request);

        return redirect()->route('admin.products.create')->with('success', 'Product '.$product->title.' created successfully!');
    }

    public function edit(Product $product)
    {
        $categories = Category::all();

        return view('admin.products.edit', compact('categories', 'product'));
    }

    public function update(Product $product, UpdateProductRequest $request)
    {
        $this->service->update($product, $request);

        return redirect()->route('admin.products.index')->with('success', 'Product updated successfully!');
    }

    public function destroy(Product $product)
    {
        $this->service->destroy($product);

        return redirect()->route('admin.products.index')->with('success', 'Product deleted successfully!');
    }
}
