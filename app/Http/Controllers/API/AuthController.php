<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Http\Services\API\AuthService;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Http\Controllers\API\BaseController as BaseController;
use Validator;

class AuthController extends BaseController
{
    protected $authService;

    public function __construct(AuthService $authService)
    {
        $this->authService = $authService;
    }

    /**
     * Register api
     *
     * @param RegisterRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function register(RegisterRequest $request)
    {
        $success = $this->authService->register($request);

        return $this->sendResponse($success, 'User register successfully.');
    }

    public function login (LoginRequest $request)
    {
        try {
            $result = $this->authService->login($request);
        } catch (ModelNotFoundException $exception) {
            return $this->sendError($exception->getMessage());
        }

        return response($result['response'], $result['code']);
    }
}
