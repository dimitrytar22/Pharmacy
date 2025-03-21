<?php

namespace App\Http\Services;

use App\Http\Requests\Admin\StoreProductRequest;
use App\Http\Requests\Admin\UpdateProductRequest;
use App\Models\Feature;
use App\Models\Product;
use Illuminate\Http\UploadedFile;

class ProductService
{
    public function update(Product $product, UpdateProductRequest $request)
    {
        $data = $request->validated();
        $image = $data['image'] ?? null;
        if ($image != null) {
            $data['image'] = "products/" . $image->getClientOriginalName();
            ImageService::moveImage($image, 'images/products');
            $product->image = $data['image'];
        }
        $featuresIds = [];
        foreach ($data['features'] as $feature) {
            if(empty($feature['title']) || empty($feature['description']))
                continue;
            $title = $feature['title'];
            $description = $feature['description'];
            $featuresIds[] = Feature::firstOrCreate([
                'title' => $title,
                'description' => $description
            ])->id;
        }
        $product->features()->sync($featuresIds);
        $product->update($data);
    }

    public function store(StoreProductRequest $request)
    {
        $data = $request->validated();



        /** @var UploadedFile $image */
        $image = $data['image'];
        $imageName = $image->getClientOriginalName();
        $imageUploaded = ImageService::moveImage($image, 'images/products', $imageName);
        if(!$imageUploaded){
            abort(300, 'File not uploaded');
        }
        $data['image'] = $imageName;

        $product = Product::firstOrCreate([
            'title' => $data['title'],
            'instruction' => $data['instruction'],
            'image' => $data['image']
        ], $data);

        $featuresIds = [];
        foreach ($data['features'] as $feature) {
            if(empty($feature['title']) || empty($feature['description']))
                continue;
            $title = $feature['title'];
            $description = $feature['description'];
            $featuresIds[] = Feature::create([
                'title' => $title,
                'description' => $description
            ])->id;
        }
        $product->features()->attach($featuresIds);

        return $product;
    }

    public function destroy(Product $product)
    {
        $product->delete();
    }
}
