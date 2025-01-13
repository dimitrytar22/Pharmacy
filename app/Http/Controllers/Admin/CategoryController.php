<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreCategoryRequest;
use App\Http\Requests\Admin\UpdateCategoryRequest;
use App\Http\Services\CategoryService;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class CategoryController extends Controller
{
    public function __construct(private CategoryService $service)
    {
    }

    public function index()
    {
        return view('admin.categories.index', [
            'categories' => Category::all()
        ]);
    }

    public function edit(Category $category)
    {
        return view('admin.categories.edit', compact('category'));
    }

    public function update(UpdateCategoryRequest $request, Category $category)
    {
        $this->service->update($request,$category);
        return redirect()->route('admin.categories.index')->with('success', 'Image changed successfully!');
    }
    public function create()
    {
        return view('admin.categories.create');
    }
    public function store(StoreCategoryRequest $request)
    {
        $this->service->store($request);
        return redirect()->route('admin.categories.index')->with('success', 'Category created successfully!');
    }
}
