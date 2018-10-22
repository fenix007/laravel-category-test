<?php

namespace App\Services;


use Illuminate\Http\UploadedFile;

class ProductPhotoService implements ProductPhotoServiceInterface
{
    private $storagePath;

    public function __construct()
    {
        $this->storagePath = config('filesystems.product.photo');
    }

    public function storePhotoAndReturnUrl(UploadedFile $uploadedFile)
    {
        $photoPath = $uploadedFile->store($this->storagePath);
        return \Storage::url($photoPath);
    }

    public function deletePhoto(string $photo): bool
    {
        return \Storage::delete($this->getStoragePathFromPublicUrl($photo));
    }

    private function getStoragePathFromPublicUrl(string $publicUrl)
    {
        return Str::replaceFirst('storage/', 'public/', $publicUrl);
    }
}
