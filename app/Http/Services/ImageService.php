<?php

namespace App\Http\Services;

use Illuminate\Support\Facades\File;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class ImageService
{
    public static function moveImage(\Illuminate\Http\UploadedFile $image, string $path, string $fileName = null)
    {

        if(!$image->move($path, $image->getClientOriginalName()))
            return false;

        return true;
    }
    public static function deleteImage(string $path): bool
    {
        if (File::exists($path)) {
            File::delete($path);
            return true;
        }

        return false;
    }
}
