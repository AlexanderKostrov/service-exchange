<?php

namespace App\Http\Repository;

use App\Order;

class OrderRepository
{
    public function findById($id)
    {
        return Order::findOrFail($id);
    }

    public function findByBidId($id)
    {
        return Order::where('id', $id)->firstOrFail();
    }

    public function create($data)
    {
        return Order::create($data);
    }
}
