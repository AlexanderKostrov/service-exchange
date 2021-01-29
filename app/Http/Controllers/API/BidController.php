<?php

namespace App\Http\Controllers\API;

use App\Bid;
use App\Http\Services\API\BidService;
use App\Order;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BidController extends BaseController
{
    protected $bidService;

    public function __construct(BidService $bidService)
    {
        $this->bidService = $bidService;
    }

    public function create($id)
    {
        try {
            $bid = $this->bidService->create($id);
        } catch (ModelNotFoundException $exception) {
            return $this->sendError($exception->getMessage());
        }

        if ($bid == 'not_owner') {
            return $this->sendError('You are owner of this order !');
        }

        if ($bid == 'exists') {
            return $this->sendError('This order already have a bid !');
        }

        return $this->sendResponse($bid, 'Bid created !');
    }

    public function approve($id)
    {
        try {
            $this->bidService->approve($id);
        } catch (ModelNotFoundException $exception) {
            return $this->sendError($exception->getMessage());
        }

        return $this->sendResponse([], 'Order and Bid in work !');
    }
}
