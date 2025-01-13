<?php

namespace App\Http\Services;

use Illuminate\Support\Facades\File;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class ImageService
{
    public static function moveImage(UploadedFile $image, string $path, string $fileName = null)
    {
        $newImage = $image->move($path, $fileName == null ? $image->getClientOriginalName() : $fileName);
        if (!File::exists($newImage->getPathName())) {
            abort(500, 'File not uploaded');
        }

        return $newImage;
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
