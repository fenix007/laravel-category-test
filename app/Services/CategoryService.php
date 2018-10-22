<?php

namespace App\Services;


use App\Models\Category;

class CategoryService implements CategoryServiceInterface
{
    public function all()
    {
        return Category::all();
    }

    public function find($id)
    {
        return Category::findOrFail($id);
    }

    public function create(array $attributes = [])
    {
        return Category::create($attributes);
    }

    public function update(Category $category, array $attributes = [])
    {
        return $category->update($attributes);
    }

    public function save(Category $category): bool
    {
        return $category->save();
    }

    public function remove(Category $category): ?bool
    {
        return $category->delete();
    }
}
