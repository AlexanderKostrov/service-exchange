<?php

namespace App\Http\Services\API;

use App\Bid;
use App\Order;
use Illuminate\Support\Facades\Auth;

class BidService
{
    public function create($id)
    {
        $order = Order::findOrFail($id);

        if ($order->user_id == Auth::id()) {
            return 'not_owner';
        }

        if (Bid::where('order_id', $id)->exists()) {
            return 'exists';
        }

        $bid = Bid::create(['order_id' => $id, 'user_id' => Auth::id()]);

        return $bid;
    }

    public function approve($id)
    {
        $bid = Bid::findOrFail($id);

        StatusService::changeStatus($bid, 'work');

        $order = Order::where('id', $bid->order_id)->firstOrFail();

        StatusService::changeStatus($order, 'work');
    }
}
