<?php

namespace App\Services;


use App\Models\Product;

interface ProductServiceInterface
{
    public function all();
    public function forCategory(int $category = null);
    public function find($id);
    public function create(array $attributes);
    public function update(Product $product, array $attributes = []);
    public function save(Product $product): bool;
    public function remove(Product $product): ?bool;
}
