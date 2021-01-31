<?php

namespace App\Http\Services\API;

use App\Bid;
use App\Http\Repository\BidRepository;
use App\Http\Repository\OrderRepository;
use App\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderService
{
    protected $bids;
    protected $orders;

    public function __construct(BidRepository $bids, OrderRepository $orders)
    {
        $this->bids = $bids;
        $this->orders = $orders;
    }

    public function create(Request $request)
    {
        $data = $request->all();

        $data['user_id'] = Auth::id();

        $order = $this->orders->create($data);

        return $order;
    }

    public function done($id)
    {
        $order = $this->orders->findById($id);

        StatusService::changeStatus($order, 'done');

        $bid = $this->bids->findByOrderId($id);

        StatusService::changeStatus($bid, 'done');

        return 'success';
    }
}
