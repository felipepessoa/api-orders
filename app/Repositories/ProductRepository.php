<?php

namespace App\Repositories;

use App\Models\Products;

class ProductRepository extends BaseRepository
{
    public function __construct(Products $products)
    {
        parent::__construct($products);
    }

    public function all()
    {
        return Products::all();
    }

    public function find($id)
    {
        return Products::findOrFail($id);
    }

    public function create($data)
    {
        return Products::create($data);
    }

    public function update($id, $data)
    {
        $products = Products::findOrFail($id);
        $products->update($data);

        return $products;
    }

    public function delete($id)
    {
        $products = Products::findOrFail($id);
        $products->delete();
    }
}
