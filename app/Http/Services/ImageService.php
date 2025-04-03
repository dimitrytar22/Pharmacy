<?php

namespace App\Http\Services;

use Illuminate\Support\Facades\Storage;

class ImageService
{
    public static function moveImage(\Illuminate\Http\UploadedFile $image, string $path, string $fileName)
    {
        return $image->storeAs('/'.$path, $fileName);
    }

    public static function deleteImage(string $path): bool
    {
        if (Storage::exists($path)) {
            Storage::delete($path);

            return true;
        }

        return false;
    }

    public static function imageExistsInDB($model, string $fileName)
    {
        return $model::query()->where('image', $fileName)->where('id', '!=', $model->id)->get()->first();
    }
}
