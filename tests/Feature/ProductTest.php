<?php

namespace Tests\Feature;

use App\Models\Product;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
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
    public function it_can_not_see_not_exists_product_item()
    {
        $this->getJson("/api/product/-1")
            ->assertStatus(404)
            ->assertJsonStructure([
                'error'
            ]);
    }

    /** @test */
    public function it_can_create_a_product()
    {
        Storage::fake('public/photo');

        $body = [
            'name' => 'test name',
            'description' => 'test description',
            'photo' => UploadedFile::fake()->image('test_photo.jpg')
        ];

        $response = $this->postJson('/api/product', $body);
        $response
            ->assertStatus(200)
            ->assertJsonStructure([
                'data' => [
                    'id', 'name', 'description', 'photo', 'categories'
                ]
            ]);

        $data = $response->json();
        $this->assertNotEmpty($data['data']['photo']);
    }

    /** @test */
    public function it_can_not_create_not_valid_product()
    {
        $body = [
            'name' => 'test name',
            'description' => 'test description',
            'photo' => ''
        ];

        $this->postJson('/api/product', $body)
            ->assertStatus(422)
            ->assertJsonStructure([
                'error'
            ]);
    }

    /** @test */
    public function it_can_update_product()
    {
        $product = Product::first();

        $this->putJson("/api/product/{$product->id}", [
            'name' => 'hello world',
            'description' => 'hello world',
            'photo' => UploadedFile::fake()->image('test_photo.jpg')
        ])
            ->assertStatus(200)
            ->assertJsonStructure([
                'data' => [
                    'id', 'name', 'description', 'photo', 'categories'
                ]
            ])
            ->assertJson([
                'data' => [
                    'name' => 'hello world',
                    'description' => 'hello world'
                ]
            ]);
    }

    /** @test */
    public function it_can_not_update_not_exists_product_item()
    {
        $this->putJson("/api/product/-1", [])
            ->assertStatus(404)
            ->assertJsonStructure([
                'error'
            ]);
    }

    /** @test */
    public function it_can_not_update_not_valid_product()
    {
        $body = [
            'name' => 'test name',
            'description' => 'test description',
            'photo' => ''
        ];

        $this->postJson('/api/product', $body)
            ->assertStatus(422)
            ->assertJsonStructure([
                'error'
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

    /** @test */
    public function it_can_not_delete_not_exists_product()
    {
        $this->deleteJson("/api/product/-1", [])
            ->assertStatus(404)
            ->assertJsonStructure([
                'error'
            ]);
    }
}
