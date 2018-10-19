<?php

namespace App\Services;


use App\Models\Category;

interface CategoryServiceInterface
{
    public function all();
    public function find($id);
    public function save(Category $category): bool;
    public function remove(Category $category): ?bool;
}
