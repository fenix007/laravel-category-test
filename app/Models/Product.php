<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $guarded = [];

    public function categories() {
        return $this->belongsToMany(Category::class);
    }

    public static function forCategory(int $category = null)
    {
        if (!$category) {
            return self::all();
        }

        return self::whereHas('categories', function($q) use ($category) {
            $q->where('id', '=', $category);
        })->get();
    }
}
