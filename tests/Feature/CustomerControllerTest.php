<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Customer;
use Illuminate\Foundation\Testing\WithFaker;

class CustomerControllerTest extends TestCase
{
    use WithFaker;

    public function testIndex()
    {
        $response = $this->get('/api/customers');
        $response->assertStatus(200);
    }

    public function testShow()
    {
        $customer = Customer::factory()->create();
        $response = $this->get("/api/customers/{$customer->id}");
        $response->assertStatus(200);
    }

    public function testStore()
    {
        $data = [
            'name'         => $this->faker->name,
            'email'        => $this->faker->unique()->safeEmail,
            'phone'        => $this->faker->phoneNumber,
            'birthdate'    => $this->faker->date,
            'address'      => $this->faker->address,
            'complement'   => $this->faker->optional()->sentence,
            'neighborhood' => $this->faker->city,
            'zip_code'     => $this->faker->postcode,
        ];

        $response = $this->postJson('/api/customers', $data);
        $response->assertStatus(201);
    }

    public function testUpdate()
    {
        $customer = Customer::factory()->create();
        $newData = [
            'name'         => $this->faker->name,
            'email'        => $this->faker->unique()->safeEmail,
            'phone'        => $this->faker->phoneNumber,
            'birthdate'    => $this->faker->date,
            'address'      => $this->faker->address,
            'complement'   => $this->faker->optional()->sentence,
            'neighborhood' => $this->faker->city,
            'zip_code'     => $this->faker->postcode,
        ];


        $response = $this->putJson("/api/customers/{$customer->id}", $newData);
        $response->assertStatus(200);
    }

    public function testDestroy()
    {
        $customer = Customer::factory()->create();

        $response = $this->delete("/api/customers/{$customer->id}");
        $response->assertStatus(200);
        $this->assertSoftDeleted('customers', ['id' => $customer->id]);
    }

    public function testStoreValidationFails()
    {
        $data = [
            // 'name' is missing
            'email'        => $this->faker->unique()->safeEmail,
            'phone'        => $this->faker->phoneNumber,
            'birthdate'    => $this->faker->date,
            'address'      => $this->faker->address,
            'complement'   => $this->faker->optional()->sentence,
            'neighborhood' => $this->faker->city,
            'zip_code'     => $this->faker->postcode,
        ];

        $response = $this->postJson('/api/customers', $data);
        $response->assertStatus(422);
        $response->assertJsonValidationErrors(['name']);
    }

    public function testUpdateValidationFails()
    {
        $customer = Customer::factory()->create();

        $data = [
            'name'         => '', // Empty name
            'email'        => 'updated@example.com',
            'phone'        => '987654321',
            'birthdate'    => '1990-01-01',
            'address'      => '456 Updated St',
            'neighborhood' => 'Uptown',
            'zip_code'     => '54321',
        ];

        $response = $this->putJson("/api/customers/{$customer->id}", $data);
        $response->assertStatus(422);
        $response->assertJsonValidationErrors(['name']);
    }
}
