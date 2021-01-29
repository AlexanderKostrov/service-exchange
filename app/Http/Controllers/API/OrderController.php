<?php

namespace App\Http\Controllers\API;

use App\Bid;
use App\Http\Services\API\OrderService;
use App\Order;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends BaseController
{
    protected $orderService;

    public function __construct(OrderService $orderService)
    {
        $this->orderService = $orderService;
    }

    public function create(Request $request)
    {
        $order = $this->orderService->create($request);

        return $this->sendResponse($order, 'Order created !');
    }

    public function done($id)
    {
        try {
            $result = $this->orderService->done($id);
        } catch (ModelNotFoundException $exception) {
            return $this->sendError($exception->getMessage());
        }

        if ($result == 'error') {
            return $this->sendError('Order not exist !');
        }

        return $this->sendResponse([], 'Order and Bid done !');
    }
}
