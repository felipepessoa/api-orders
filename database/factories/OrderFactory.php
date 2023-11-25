<?php

namespace Database\Factories;

use App\Models\Orders;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class OrderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = Orders::class;
    public function definition()
    {
        return [
            'customer_id'   => \App\Models\Customers::factory(),
            'product_id'    => \App\Models\Products::factory(),
            'creation_date' => $this->faker->date,
        ];
    }

}
