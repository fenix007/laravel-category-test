<?php

namespace App\Transformers;


use App\Models\Product;
use League\Fractal\TransformerAbstract;

class ProductTransformer extends TransformerAbstract
{
    protected $defaultIncludes = [
        'categories'
    ];

    public function transform(Product $product)
    {
        return [
            'id' => $product->id,
            'name' => $product->name,
            'description' => $product->description,
            'photo' => $product->photo
        ];
    }

    public function includeCategories(Product $product)
    {
        $categories = $product->categories()->get();

        return $this->collection($categories, new CategoryTransformer);
    }
}
