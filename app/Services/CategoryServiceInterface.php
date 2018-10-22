<?php

namespace App\Services;


use App\Models\Category;

interface CategoryServiceInterface
{
    public function all();
    public function find($id);
    public function create(array $attributes);
    public function update(Category $category, array $attributes = []);
    public function save(Category $category): bool;
    public function remove(Category $category): ?bool;
}
