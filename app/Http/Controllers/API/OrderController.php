<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\OrderCreateRequest;
use App\Http\Services\API\OrderService;
use Illuminate\Database\Eloquent\ModelNotFoundException;


class OrderController extends BaseController
{
    protected $orderService;

    public function __construct(OrderService $orderService)
    {
        $this->orderService = $orderService;
    }

    public function create(OrderCreateRequest $request)
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

        return $this->sendResponse([], 'Order and Bid done !');
    }
}
