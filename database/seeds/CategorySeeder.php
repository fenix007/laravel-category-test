<?php

use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    const MAX_CATEGORIES_ID = 10;

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = [
            ['id' => 1, 'name' => 'TV & Home Theather'],
            ['id' => 2, 'name' => 'Tablets & E-Readers'],
            ['id' => 3, 'name' => 'Computers', 'children' => [
                ['id' => 4, 'name' => 'Laptops', 'children' => [
                    ['id' => 5, 'name' => 'PC Laptops'],
                    ['id' => 6, 'name' => 'Macbooks (Air/Pro)']
                ]],
                ['id' => 7, 'name' => 'Desktops', 'children' => [
                    // These will be created
                    ['id' => 8, 'name' => 'Towers Only'],
                    ['id' => 9, 'name' => 'Desktop Packages'],
                ]],
            ]],
            ['id' => 10, 'name' => 'Cell Phones']
        ];

        \App\Models\Category::buildTree($categories);
    }

    public static function getRandomCategories($number): array
    {
        $randomCategoriesIds = range(1, self::MAX_CATEGORIES_ID);
        shuffle($randomCategoriesIds);
        $randomCategoriesIds = array_slice($randomCategoriesIds, 0, $number);
        return array_map(function ($catId) {return \App\Models\Category::find($catId);}, $randomCategoriesIds);
    }
}
