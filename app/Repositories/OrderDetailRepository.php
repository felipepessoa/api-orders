<?php

namespace App\Repositories;

use App\Models\OrderDetail;

class OrderDetailRepository extends BaseRepository
{
    public function __construct(OrderDetail $orderDetail)
    {
        parent::__construct($orderDetail);
    }
    public function all()
    {
        return OrderDetail::all();
    }

    public function find($id)
    {
        return OrderDetail::findOrFail($id);
    }

    public function create($data)
    {
        return OrderDetail::create($data);
    }

    public function update($id, $data)
    {
        $orderDetail = OrderDetail::findOrFail($id);
        $orderDetail->update($data);

        return $orderDetail;
    }

    public function delete($id)
    {
        $orderDetail = OrderDetail::findOrFail($id);
        $orderDetail->delete();
    }
}
