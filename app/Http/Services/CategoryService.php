<?php

namespace App\Http\Services;

use App\Http\Requests\Admin\StoreCategoryRequest;
use App\Http\Requests\Admin\UpdateCategoryRequest;
use App\Models\Category;
use Illuminate\Support\Facades\File;

class CategoryService
{
    public function update(UpdateCategoryRequest $request, Category $category)
    {
        $title = $request->input('title');
        $image = $request->file('image');
        if ($image != null) {
            $oldImagePath = 'images/' . $category->image;

            ImageService::deleteImage($oldImagePath);
            $newImage = ImageService::moveImage($image,'images/categories');

            $category->image = 'categories/' . $newImage->getFilename();
        }

        $category->title = $title;
        $category->save();
    }
    public function store(StoreCategoryRequest $request) : Category
    {

        $title = $request->input('title');
        $image = ImageService::moveImage($request->file('image'),'images/categories');
        return Category::create([
            'title' => $title,
            'image' => 'categories/'.$image->getFilename(),
        ]);
    }

}
