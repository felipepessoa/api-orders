<?php

namespace App\Repositories;

use App\Models\Order;

class OrderRepository extends BaseRepository
{
    public function __construct(Order $order)
    {
        parent::__construct($order);
    }
    public function all()
    {
        return Order::all();
    }

    public function find($id)
    {
        return Order::findOrFail($id);
    }

    public function create($data)
    {
        return Order::create($data);
    }

    public function update($id, $data)
    {
        $order = Order::findOrFail($id);
        $order->update($data);

        return $order;
    }

    public function delete($id)
    {
        $order = Order::findOrFail($id);
        $order->delete();
    }
}
