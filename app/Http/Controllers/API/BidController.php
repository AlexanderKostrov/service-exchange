<?php

namespace App\Http\Controllers\API;

use App\Bid;
use App\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BidController extends BaseController
{
    public function create($id)
    {
        $order = Order::find($id);

        if ($order->user_id == Auth::id()) {
            return $this->sendError('You are owner of this order !');
        }

        if (Bid::where('order_id', $id)->exists()) {
            return $this->sendError('This order already have a bid !');
        }

        $bid = Bid::create(['order_id' => $id, 'user_id' => Auth::id()]);

        return $this->sendResponse($bid, 'Bid created !');
    }

    public function approve($id)
    {
        $bid = Bid::find($id);

        $bid->update(['status' => 'work']);

        $order = Order::where('id', $bid->order_id)->update(['status' => 'work']);

        return $this->sendResponse([], 'Order and Bid in work !');
    }
}
