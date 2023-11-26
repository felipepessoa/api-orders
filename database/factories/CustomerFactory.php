<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

use App\Models\Customer;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class CustomerFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = Customer::class;
    public function definition()
    {
        return [
            'name'         => $this->faker->name,
            'email'        => $this->faker->unique()->safeEmail,
            'phone'        => $this->faker->phoneNumber,
            'birthdate'    => $this->faker->date,
            'address'      => $this->faker->address,
            'complement'   => $this->faker->optional()->sentence,
            'neighborhood' => $this->faker->city,
            'zip_code'     => $this->faker->postcode,
        ];
    }
}
