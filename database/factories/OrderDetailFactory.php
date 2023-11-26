<?php

namespace Database\Factories;

use Faker\Core\Number;
use Illuminate\Database\Eloquent\Factories\Factory;

use App\Models\OrderDetail;
use App\Models\Order;
use App\Models\Product;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\OrderDetail>
 */
class OrderDetailFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = OrderDetail::class;
    public function definition(): array
    {
        $product = Product::factory()->createOne();
        $quantity = $this->faker->randomDigit();
        $price = $product->price * $quantity;
        return [
            'order_id'   => Order::factory(),
            'product_id' => $product->id,
            'quantity'   => $quantity,
            'price'      => $price
        ];

    }
}
