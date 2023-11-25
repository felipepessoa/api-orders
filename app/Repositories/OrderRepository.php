<?php

namespace App\Repositories;

use App\Models\Orders;

class OrderRepository extends BaseRepository
{
    public function __construct(Orders $orders)
    {
        parent::__construct($orders);
    }
    public function all()
    {
        return Orders::all();
    }

    public function find($id)
    {
        return Orders::findOrFail($id);
    }

    public function create($data)
    {
        return Orders::create($data);
    }

    public function update($id, $data)
    {
        $orders = Orders::findOrFail($id);
        $orders->update($data);

        return $orders;
    }

    public function delete($id)
    {
        $orders = Orders::findOrFail($id);
        $orders->delete();
    }
}
