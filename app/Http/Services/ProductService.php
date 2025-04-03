<?php

namespace App\Http\Services;

use App\Http\Requests\Admin\StoreProductRequest;
use App\Http\Requests\Admin\UpdateProductRequest;
use App\Models\Feature;
use App\Models\Product;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Log;

class ProductService
{
    public function update(Product $product, UpdateProductRequest $request)
    {
        $data = $request->validated();
        $image = $data['image'] ?? null;
        $features = $data['features'] ?? null;
        if ($image) {
            $newImageName = $image->getClientOriginalName();
            if (!ImageService::imageExistsInDB($product, $product->image)) {
                ImageService::deleteImage($product->image);
            }

            $newImage = ImageService::moveImage($image, 'images/products/', $newImageName);
            if (!$newImage) {
                abort(500, 'File not uploaded');
            }
            $data['image'] = 'images/products/' . $newImageName;
        }

        if ($features) {
            $featuresIds = [];
            foreach ($data['features'] as $feature) {
                $title = $feature['title'];
                $description = $feature['description'];
                $featuresIds[] = Feature::query()->firstOrCreate([
                    'title' => $title,
                    'description' => $description,
                ])->id;
            }

            $product->features()->sync($featuresIds);
        }
        $product->update($data);
    }

    public function store(StoreProductRequest $request)
    {
        $data = $request->validated();

        /** @var UploadedFile $image */
        $image = $data['image'];
        $imageName = $image->getClientOriginalName();
        $imageUploaded = ImageService::moveImage($image, 'images/products/', $imageName);
        if (!$imageUploaded) {
            abort(300, 'File not uploaded');
        }
        $data['image'] = 'images/products/' . $imageName;

        $product = Product::firstOrCreate([
            'title' => $data['title'],
            'instruction' => $data['instruction'],
            'image' => $data['image'],
        ], $data);

        $featuresIds = [];
        foreach ($data['features'] as $feature) {
            $title = $feature['title'];
            $description = $feature['description'];
            $featuresIds[] = Feature::query()->firstOrCreate([
                'title' => $title,
                'description' => $description,
            ])->id;
        }
        $product->features()->attach($featuresIds);

        return $product;
    }

    public function destroy(Product $product)
    {
        if (!ImageService::imageExistsInDB($product, $product->image)) {
            ImageService::deleteImage($product->image);
        }
        $product->features()->detach();
        $product->delete();
    }
}
