<?php

namespace App\Http\Services\API;

use App\Bid;
use App\Http\Repository\BidRepository;
use App\Http\Repository\OrderRepository;
use App\Order;
use Illuminate\Support\Facades\Auth;

class BidService
{
    protected $bids;
    protected $orders;

    public function __construct(BidRepository $bids, OrderRepository $orders)
    {
        $this->bids = $bids;
        $this->orders = $orders;
    }

    public function create($id)
    {
        $order = $this->orders->findById($id);

        if ($order->user_id == Auth::id()) {
            return 'not_owner';
        }

        if ($this->bids->findByOrderId($id)->exists()) {
            return 'exists';
        }

        $bid = $this->bids->create(['order_id' => $id, 'user_id' => Auth::id()]);

        return $bid;
    }

    public function approve($id)
    {
        $bid = $this->bids->findById($id);

        StatusService::changeStatus($bid, 'work');

        $order = $this->orders->findByBidId($bid->order_id);

        StatusService::changeStatus($order, 'work');
    }
}
