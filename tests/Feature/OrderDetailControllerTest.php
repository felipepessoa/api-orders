<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\OrderDetail;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Foundation\Testing\WithFaker;

class OrderDetailControllerTest extends TestCase
{
    use WithFaker;

    public function testIndex()
    {
        $response = $this->get('/api/order-details');
        $response->assertStatus(200);
    }

    public function testShow()
    {
        $orderDetail = OrderDetail::factory()->create();
        $response = $this->get("/api/order-details/{$orderDetail->id}");
        $response->assertStatus(200);
    }

    public function testStore()
    {
        $product = Product::factory()->createOne();
        $quantity = $this->faker->randomDigit();
        $price = $product->price * $quantity;
        $order = Order::factory()->create();

        $data = [
            'order_id'   => $order->id,
            'product_id' => $product->id,
            'quantity'   => $quantity,
            'price'      => $price
        ];

        $response = $this->post('/api/order-details', $data);
        $response->assertStatus(201);
    }

    public function testUpdate()
    {
        $orderDetail = OrderDetail::factory()->create();
        $product = Product::factory()->createOne();
        $quantity = $this->faker->randomDigit();
        $price = $product->price * $quantity;
        $order = Order::factory()->create();

        $data = [
            'order_id'   => $order->id,
            'product_id' => $product->id,
            'quantity'   => $quantity,
            'price'      => $price
        ];

        $response = $this->put("/api/order-details/{$orderDetail->id}", $data);
        $response->assertStatus(200);
    }

    public function testDestroy()
    {
        $orderDetail = OrderDetail::factory()->create();

        $response = $this->delete("/api/order-details/{$orderDetail->id}");
        $response->assertStatus(200);
        $this->assertSoftDeleted('order_details', ['id' => $orderDetail->id]);
    }

    public function testStoreValidationFails()
    {
        $data = [
            'product_id' => Product::factory()->create()->id,
            'quantity'   => 9.99,
            'price'      => 'aaaa',
        ];

        $response = $this->postJson('/api/order-details', $data);
        $response->assertStatus(422);
        $response->assertJsonValidationErrors(['order_id', 'quantity', 'price']);
    }

    public function testUpdateValidationFails()
    {
        $orderDetail = OrderDetail::factory()->create();

        $data = [
            'order_id' => '', // Empty order_id
            'quantity' => 9.99,
            'price'    => 'aaaa',
        ];

        $response = $this->putJson("/api/order-details/{$orderDetail->id}", $data);
        $response->assertStatus(422);
        $response->assertJsonValidationErrors(['order_id', 'quantity', 'price']);
    }
}
