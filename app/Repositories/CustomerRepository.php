<?php

namespace App\Repositories;

use App\Models\Customer;

class CustomerRepository extends BaseRepository
{
    public function __construct(Customer $customer)
    {
        parent::__construct($customer);
    }

    public function all()
    {
        return Customer::all();
    }

    public function find($id)
    {
        return Customer::findOrFail($id);
    }

    public function create($data)
    {
        return Customer::create($data);
    }

    public function update($id, $data)
    {
        $customers = Customer::findOrFail($id);
        $customers->update($data);

        return $customers;
    }

    public function delete($id)
    {
        $customer = Customer::findOrFail($id);
        $customer->delete();
    }
}
