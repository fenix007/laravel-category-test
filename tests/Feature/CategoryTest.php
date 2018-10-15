<?php

namespace Tests\Feature;


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
                        'id', 'name'
                    ]
                ]
            ]);
    }
}