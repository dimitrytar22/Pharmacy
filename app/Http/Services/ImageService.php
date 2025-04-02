<?php

namespace App\Http\Services;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\File\UploadedFile;

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
