<?php

namespace Tests\Feature;


use App\Category;
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
    public function it_can_delete_category()
    {
        $category = Category::first();

        $this->deleteJson("/api/category/{$category->id}", [])
            ->assertStatus(204);

        $this->assertDatabaseMissing('categories', ['id' => $category->id]);
    }
}
