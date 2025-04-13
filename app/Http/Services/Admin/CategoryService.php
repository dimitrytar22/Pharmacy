<?php

namespace App\Http\Services\Admin;

use App\Http\Requests\Admin\StoreCategoryRequest;
use App\Http\Requests\Admin\UpdateCategoryRequest;
use App\Http\Services\ImageService;
use App\Models\Category;
use App\Models\Product;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class CategoryService
{
    public function update(UpdateCategoryRequest $request, Category $category)
    {
        $data = $request->validated();
        $title = $data['title'];
        $image = $data['image'] ?? null;

        if ($image) {
            $oldImageName = basename($category->image);
            $newImageName = $image->getClientOriginalName();
            if (!ImageService::imageExistsInDB($category, $category->image)) {
                ImageService::deleteImage($category->image);
            }

            $newImage = ImageService::moveImage($image, 'images/categories/', $newImageName);
            if (!$newImage) {
                abort(500, 'File not uploaded');
            }
            $category->image = 'images/categories/' . $newImageName;
        }

        $category->title = $title;
        $category->save();
    }

    public function store(StoreCategoryRequest $request): Model
    {
        $data = $request->validated();
        $image = $data['image'];
        $imageName = $image->getClientOriginalName();
        $imageUploaded = ImageService::moveImage($image, 'images/categories', $imageName);
        if (!$imageUploaded) {
            abort(500, 'File not uploaded');
        }
        $data['image'] = 'images/categories/' . $imageName;

        return Category::query()->create($data);
    }

    public function destroy(Category $category)
    {


        $category->delete();
    }

    public function forceDestroy(Category $category)
    {
        if (!ImageService::imageExistsInDB($category, $category->image)) {
            ImageService::deleteImage($category->image);
        }
        $category->products()->each(function (Product $product) {
            $product->update([
                'category_id' => null
            ]);
        });
        return $category->forceDelete();
    }

    public function restore(Category $category)
    {
        return $category->restore();
    }
}
