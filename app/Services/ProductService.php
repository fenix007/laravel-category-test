<?php

namespace App\Services;


use App\Models\Product;

class ProductService implements ProductServiceInterface
{
    private $productPhotoService;

    public function __construct(ProductPhotoService $productPhotoService)
    {
        $this->productPhotoService = $productPhotoService;
    }

    public function all()
    {
        return Product::all();
    }

    public function forCategory(int $category = null)
    {
        if (!$category) {
            return $this->all();
        }

        return Product::whereHas('categories', function($q) use ($category) {
            $q->where('id', '=', $category);
        })->get();
    }

    public function find($id)
    {
        return Product::findOrFail($id);
    }

    public function create(array $attributes = [])
    {
        $attributes['photo'] = $this->productPhotoService->storePhotoAndReturnUrl($attributes['photo']);

        return Product::create($attributes);
    }

    public function update(Product $product, array $attributes = [])
    {
        $attributes['photo'] = $this->productPhotoService->storePhotoAndReturnUrl($attributes['photo']);

        return $product->update($attributes);
    }

    public function save(Product $product): bool
    {
        return $product->save();
    }

    public function remove(Product $product): ?bool
    {
        $this->productPhotoService->deletePhoto($product->photo);

        return $product->delete();
    }
}
