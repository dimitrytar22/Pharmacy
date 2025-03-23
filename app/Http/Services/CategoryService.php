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
        $data = $request->validated();
        $image = $data['image'];
        $title = $data['title'];

        $oldImageName = basename($category->image);
        $newImageName = $image->getClientOriginalName();
        if (!ImageService::imageExistsInDB($category, $oldImageName))
            ImageService::deleteImage(Category::$imageDir  . $oldImageName);

        $newImage = ImageService::moveImage($image, Category::$imageDir , $newImageName);
        if (!$newImage) {
            abort(500, 'File not uploaded');
        }
        $category->image = $newImageName;


        $category->title = $title;
        $category->save();
    }

    public function store(StoreCategoryRequest $request): Category
    {
        $data = $request->validated();
        $image = $data['image'];
        $imageName = $image->getClientOriginalName();
        $imageUploaded = ImageService::moveImage($image, 'images/categories', $imageName);
        if (!$imageUploaded) {
            abort(500, 'File not uploaded');
        }
        $data['image'] = $imageName;
        return Category::firstOrCreate([
            'title' => $data['title'],
            'image' => $data['image'],
        ], $data);
    }

    public function destroy(Category $category)
    {
        if (!ImageService::imageExistsInDB($category, basename($category->image)))
            ImageService::deleteImage(Category::$imageDir . basename($category->image));
        $category->delete();
    }
}
