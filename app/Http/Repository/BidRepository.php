<?php

namespace App\Http\Repository;

use App\Bid;

class BidRepository
{
    public function findByOrderId($id)
    {
        return Bid::where('order_id', $id);
    }

    public function create($data)
    {
        return Bid::create($data);
    }

    public function findById($id)
    {
        return Bid::findOrFail($id);
    }
}
