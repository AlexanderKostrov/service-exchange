<?php


namespace App\Http\Services\API;


use App\Bid;
use App\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderService
{
    public function create(Request $request)
    {
        $data = $request->all();

        $data['user_id'] = Auth::id();

        $order = Order::create($data);

        return $order;
    }

    public function done($id)
    {
        $order = Order::findOrFail($id);

        $order->update(['status' => 'done']);

        $bid = Bid::where('order_id', $id)->firstOrFail();

        $bid->update(['status' => 'done']);

        return 'success';
    }
}
