<?php

namespace App\Transformers;


use App\Models\Category;
use League\Fractal\TransformerAbstract;

class HierarchyCategoryTransformer extends TransformerAbstract
{
    public function transform(Category $category)
    {
        if (isset($category['children'])) {
            $item = [
                'id'       => $category->id,
                'name'     => $category->name
            ];

            foreach ($category->children as $key => $value) {
                $item['children'][] = $this->transform($value);
            }

            return $item;
        } else {
            return [
                'id'   => $category->id,
                'name' => $category->name
            ];
        }
    }
}
