<?php

namespace App\Services;


use Illuminate\Http\UploadedFile;

interface ProductPhotoServiceInterface
{
    public function storePhotoAndReturnUrl(UploadedFile $uploadedFile);
    public function deletePhoto(string $photo): bool;
}
