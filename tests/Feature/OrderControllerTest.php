<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Order;
use App\Models\Customer;
use App\Models\Product;
use Illuminate\Foundation\Testing\WithFaker;

class OrderControllerTest extends TestCase
{
    use WithFaker;

    public function testIndex()
    {
        $response = $this->get('/api/orders');
        $response->assertStatus(200);
    }

    public function testShow()
    {
        $order = Order::factory()->create();
        $response = $this->get("/api/orders/{$order->id}");
        $response->assertStatus(200);
    }

    public function testStore()
    {
        $customer = Customer::factory()->create();

        $data = [
            'customer_id' => $customer->id,
        ];

        $response = $this->post('/api/orders', $data);
        $response->assertStatus(201);
    }

    public function testUpdate()
    {
        $order = Order::factory()->create();
        $customer = Customer::factory()->create();

        $data = [
            'customer_id' => $customer->id,
        ];

        $response = $this->put("/api/orders/{$order->id}", $data);
        $response->assertStatus(200);
    }

    public function testDestroy()
    {
        $order = Order::factory()->create();

        $response = $this->delete("/api/orders/{$order->id}");
        $response->assertStatus(200);
        $this->assertSoftDeleted('orders', ['id' => $order->id]);
    }

    public function testStoreValidationFails()
    {
        $data = [
            'customer_id' => ''
        ];

        $response = $this->postJson('/api/orders', $data);
        $response->assertStatus(422);
        $response->assertJsonValidationErrors(['customer_id']);
    }

    public function testUpdateValidationFails()
    {
        $order = Order::factory()->create();

        $data = [
            'customer_id' => '', // Empty customer_id
        ];

        $response = $this->putJson("/api/orders/{$order->id}", $data);
        $response->assertStatus(422);
        $response->assertJsonValidationErrors(['customer_id']);
    }
}
