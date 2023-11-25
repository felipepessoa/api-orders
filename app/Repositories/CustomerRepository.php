<?php

namespace App\Repositories;

use App\Models\Customers;

class CustomerRepository extends BaseRepository
{
    public function __construct(Customers $customers)
    {
        parent::__construct($customers);
    }

    public function all()
    {
        return Customers::all();
    }

    public function find($id)
    {
        return Customers::findOrFail($id);
    }

    public function create($data)
    {
        return Customers::create($data);
    }

    public function update($id, $data)
    {
        $customers = Customers::findOrFail($id);
        $customers->update($data);

        return $customers;
    }

    public function delete($id)
    {
        $customer = Customers::findOrFail($id);
        $customer->delete();
    }
}
