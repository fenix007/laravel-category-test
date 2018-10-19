<?php

namespace App\Models;

use Baum\Node;

class Category extends Node
{
    public function products() {
        return $this->belongsToMany(Product::class);
    }
}
