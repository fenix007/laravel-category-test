<?php

namespace Tests\Feature;


use App\Models\Category;
use Tests\TestCase;

class CategoryTest extends TestCase
{
    public function setUp()
    {
        parent::setUp();

        $this->seed(\CategorySeeder::class);
    }

    /** @test */
    public function it_can_see_list_of_categories()
    {
        $this->getJson('/api/category')
            ->assertStatus(200)
            ->assertJsonStructure([
                'data' => [
                    '*' => [
                        'id', 'name', 'parent_id'
                    ]
                ]
            ]);
    }

    /** @test */
    public function it_can_see_single_category_item()
    {
        $category = Category::first();

        $this->getJson("/api/category/{$category->id}")
            ->assertStatus(200)
            ->assertJsonStructure([
                'data' => [
                    'id', 'name'
                ]
            ]);
    }

    /** @test */
    public function it_can_not_see_not_exists_category_item()
    {
        $this->getJson("/api/category/-1")
            ->assertStatus(404)
            ->assertJsonStructure([
                'error'
            ]);
    }

    /** @test */
    public function it_can_create_a_category()
    {
        $body = [
            'name' => 'test'
        ];

        $this->postJson('/api/category', $body)
            ->assertStatus(200)
            ->assertJsonStructure([
                'data' => [
                    'id', 'name'
                ]
            ]);
    }

    /** @test */
    public function it_can_not_create_not_valid_category()
    {
        $body = [
            'name' => ''
        ];

        $this->postJson('/api/category', $body)
            ->assertStatus(422)
            ->assertJsonStructure([
                'error'
            ]);
    }

    /** @test */
    public function it_can_update_category()
    {
        $category = Category::first();

        $this->putJson("/api/category/{$category->id}", [
            'name' => 'hello world'
        ])
            ->assertStatus(200)
            ->assertJsonStructure([
                'data' => [
                    'id', 'name'
                ]
            ])
            ->assertJson([
                'data' => [
                    'name' => 'hello world'
                ]
            ]);
    }

    /** @test */
    public function it_can_not_update_not_exists_category_item()
    {
        $this->putJson("/api/category/-1", [])
            ->assertStatus(404)
            ->assertJsonStructure([
                'error'
            ]);
    }

    /** @test */
    public function it_can_delete_category()
    {
        $category = Category::first();

        $this->deleteJson("/api/category/{$category->id}", [])
            ->assertStatus(204);

        $this->assertDatabaseMissing('categories', ['id' => $category->id]);
    }

    /** @test */
    public function it_can_not_delete_not_exists_category()
    {
        $this->deleteJson("/api/category/-1", [])
            ->assertStatus(404)
            ->assertJsonStructure([
                'error'
            ]);
    }
}
