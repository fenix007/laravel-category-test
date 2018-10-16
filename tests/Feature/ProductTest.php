<?php

namespace Tests\Feature;

use App\Product;
use Tests\TestCase;

class ProductTest extends TestCase
{
    public function setUp()
    {
        parent::setUp();

        $this->seed(\CategorySeeder::class);
        $this->seed(\ProductSeeder::class);
    }

    /** @test */
    public function it_can_see_list_of_products()
    {
        $this->getJson('/api/product')
            ->assertStatus(200)
            ->assertJsonStructure([
                'data' => [
                    '*' => [
                        'id', 'name', 'description', 'photo', 'categories'
                    ]
                ]
            ]);
    }

    /** @test */
    public function it_can_not_see_list_of_products_not_exists_category()
    {
        $this->getJson('/api/product?category=-1')
            ->assertStatus(200)
            ->assertExactJson(["data" => []]);
    }

    /** @test */
    public function it_can_see_single_product_item()
    {
        $product = Product::first();

        $this->getJson("/api/product/{$product->id}")
            ->assertStatus(200)
            ->assertJsonStructure([
                'data' => [
                    'id', 'name', 'description', 'photo', 'categories'
                ]
            ]);
    }

    /** @test */
    public function it_can_create_a_product()
    {
        $body = [
            'name' => 'test name',
            'description' => 'test description',
            'photo' => 'test photo'
        ];

        $this->postJson('/api/product', $body)
            ->assertStatus(200)
            ->assertJsonStructure([
                'data' => [
                    'id', 'name', 'description', 'photo', 'categories'
                ]
            ]);
    }

    /** @test */
    public function it_can_update_product()
    {
        $product = Product::first();

        $this->putJson("/api/product/{$product->id}", [
            'name' => 'hello world'
        ])
            ->assertStatus(200)
            ->assertJsonStructure([
                'data' => [
                    'id', 'name', 'description', 'photo', 'categories'
                ]
            ])
            ->assertJson([
                'data' => [
                    'name' => 'hello world'
                ]
            ]);
    }

    /** @test */
    public function it_can_delete_product()
    {
        $product = Product::first();

        $this->deleteJson("/api/product/{$product->id}", [])
            ->assertStatus(204);

        $this->assertDatabaseMissing('products', ['id' => $product->id]);
    }
}
