<?php

namespace HaiCS\Laravel\Api\Response\Test\Feature;

use HaiCS\Laravel\Api\Response\Test\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ApiResponseTest extends TestCase
{
    use RefreshDatabase;
    /**
     * @test
     */
    public function can_retrieve_json_item()
    {
        $response = $this->get(route('get.item'));

        $response->assertStatus(200);
        $response->assertJsonStructure([
            'data' => ['title', 'description', 'author'],
        ]);
    }

    /**
     * @test
     */
    public function can_retrieve_json_collection()
    {
        $response = $this->get(route('get.collection'));

        $response->assertStatus(200);
        $response->assertJsonStructure([
            'data' => [],
        ]);
    }

    /**
     * @test
     */
    public function can_retrieve_json_paginator()
    {
        $response = $this->get(route('get.paginator'));

        $response->assertStatus(200);
        $response->assertJsonStructure([
            'data' => [],
            'meta' => [
                'pagination' => [
                    'total',
                    'count',
                    'per_page',
                    'current_page',
                    'total_pages',
                    'links',
                ],
            ],
        ]);
    }

    /**
     * @test
     */
    public function can_retrieve_json_success()
    {
        $response = $this->get(route('success'));

        $response->assertStatus(200);
        $response->assertJson([
            'success' => true,
        ]);
    }

    /**
     * @test
     */
    public function can_retrieve_json_include_relation()
    {
        $response = $this->call('GET', route('categories.detail'), ['include' => 'books']);

        $response->assertStatus(200);
        $response->assertJsonStructure([
            'data' => ['books'],
        ]);
    }
}
