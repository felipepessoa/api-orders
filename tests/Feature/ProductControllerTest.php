<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Product;
use Illuminate\Foundation\Testing\WithFaker;

class ProductControllerTest extends TestCase
{
    use WithFaker;

    public function testIndex()
    {
        $response = $this->get('/api/products');
        $response->assertStatus(200);
    }

    public function testShow()
    {
        $product = Product::factory()->create();
        $response = $this->get("/api/products/{$product->id}");
        $response->assertStatus(200);
    }

    public function testStore()
    {
        $data = [
            'name'  => $this->faker->word,
            'price' => $this->faker->randomFloat(2, 10, 100),
            'photo' => $this->faker->imageUrl(),
        ];

        $response = $this->postJson('/api/products', $data);
        $response->assertStatus(201);
    }

    public function testUpdate()
    {
        $product = Product::factory()->create();

        $data = [
            'name'  => 'Updated Product',
            'price' => 50.99,
            'photo' => $this->faker->imageUrl(),
        ];

        $response = $this->putJson("/api/products/{$product->id}", $data);
        $response->assertStatus(200);
    }

    public function testDestroy()
    {
        $product = Product::factory()->create();

        $response = $this->delete("/api/products/{$product->id}");
        $response->assertStatus(200);
        $this->assertSoftDeleted('products', ['id' => $product->id]);
    }

    public function testStoreValidationFails()
    {
        $data = [
            // 'name' is missing
            'price' => $this->faker->randomFloat(2, 10, 100),
            'photo' => $this->faker->imageUrl(),
        ];

        $response = $this->postJson('/api/products', $data);
        $response->assertStatus(422); // HTTP status code for Unprocessable Entity (Validation Failed)
        $response->assertJsonValidationErrors(['name']);
    }

    public function testUpdateValidationFails()
    {
        $product = Product::factory()->create();

        $data = [
            'name'  => '', // Empty name
            'price' => 'not_a_number', // Non-numeric price
            'photo' => $this->faker->imageUrl(),
        ];

        $response = $this->putJson("/api/products/{$product->id}", $data);
        $response->assertStatus(422);
        $response->assertJsonValidationErrors(['name', 'price']);
    }
}
