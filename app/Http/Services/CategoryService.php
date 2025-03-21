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
        $data = $request->validated();
        $image = $data['image'];
        $imageName = $image->getClientOriginalName();
        $imageUploaded = ImageService::moveImage($image,'images/categories', $imageName);
        if(!$imageUploaded){
            abort(300, 'File not uploaded');
        }
        $data['image'] = $imageName;
        return Category::firstOrCreate([
            'title' =>  $data['title'],
            'image' => $data['image'],
        ], $data);
    }

}
