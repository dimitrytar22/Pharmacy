<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreCategoryRequest;
use App\Http\Requests\Admin\UpdateCategoryRequest;
use App\Http\Services\Admin\CategoryService;
use App\Models\Category;

class CategoryController extends Controller
{
    public function __construct(private CategoryService $service) {}

    public function index()
    {
        return view('admin.categories.index', [
            'categories' => Category::all(),
        ]);
    }

    public function edit(Category $category)
    {
        return view('admin.categories.edit', compact('category'));
    }

    public function update(UpdateCategoryRequest $request, Category $category)
    {
        $this->service->update($request, $category);

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

    public function destroy(Category $category)
    {
        $this->service->destroy($category);

        return redirect()->route('admin.categories.index')->with('success', 'Category deleted successfully!');
    }
    public function deleted()
    {
        $deletedCategories = Category::onlyTrashed()->paginate(20);
        return view('admin.categories.deleted', compact('deletedCategories'));
    }
    public function restore(Category $category)
    {
        $this->service->restore($category);
        return redirect()->route('admin.categories.deleted.index')->with('success', 'Category restored successfully!');
    }
    public function forceDestroy(Category $category)
    {
        $this->service->forceDestroy($category);
        return redirect()->route('admin.categories.deleted.index')->with('success', 'Category deleted permanently!');
    }
}
