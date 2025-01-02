<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\UpdateCategoryRequest;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class CategoryController extends Controller
{
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
        $title = $request->input('title');
        $image = $request->file('image');
        $oldImagePath = 'images/' . $category->image;

        if (File::exists($oldImagePath))
            File::delete($oldImagePath);

        $newImage = $image->move('images/categories', $image->getClientOriginalName());
        if(!File::exists($newImage->getPathName()))
            abort(500, 'File not uploaded');

        $category->update([
            'image' => 'categories/'. $newImage->getFilename()
        ]);

        return redirect()->route('admin.categories.index')->with('success','Image changed successfully!');
    }
}
