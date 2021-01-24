<?php

namespace App\Http\Controllers\API;

use App\Bid;
use App\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends BaseController
{
    public function create(Request $request)
    {
        $data = $request->all();

        $data['user_id'] = Auth::id();

        $order = Order::create($data);

        return $this->sendResponse($order, 'Order created !');
    }

    public function done($id)
    {
        $order = Order::find($id);

        if (!$order) {
            return $this->sendError('Order not exist !');
        }

        $order->update(['status' => 'done']);

        $bid = Bid::where('order_id', $id)->update(['status' => 'done']);

        return $this->sendResponse([], 'Order and Bid done !');
    }
}
