<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    const PROD_MAX_CATEGORIES = 3;
    const MAX_CATEGORIES_ID = 10;

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(CategorySeeder::class);
        factory(App\Product::class, 50)->create()->each(function ($p) {
            $numCategories = rand(1, self::PROD_MAX_CATEGORIES);
            $p->categories()->saveMany($this->getRandomCategories($numCategories));
        });
    }

    public function getRandomCategories($number): array
    {
        $randomCategoriesIds = range(1, self::MAX_CATEGORIES_ID);
        shuffle($randomCategoriesIds);
        $randomCategoriesIds = array_slice($randomCategoriesIds, 0, $number);
        return array_map(function ($catId) {return \App\Category::find($catId);}, $randomCategoriesIds);
    }
}
