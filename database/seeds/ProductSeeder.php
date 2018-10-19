<?php

use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    const PROD_MAX_CATEGORIES = 3;

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Models\Product::class, 50)->create()->each(function ($p) {
            $numCategories = rand(1, self::PROD_MAX_CATEGORIES);
            $p->categories()->saveMany(CategorySeeder::getRandomCategories($numCategories));
        });
    }
}
