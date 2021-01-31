<?php

namespace App\Http\Services\API;

use App\Http\Repository\UserRepository;
use Illuminate\Support\Facades\Hash;

class AuthService
{
    protected $users;

    public function __construct(UserRepository $users)
    {
        $this->users = $users;
    }

    public function register($request)
    {
        $input = $request->all();
        $input['password'] = bcrypt($input['password']);

        $user = $this->users->create($input);

        $success['token'] =  $user->createToken('MyApp')->accessToken;
        $success['name'] =  $user->name;

        return $success;
    }

    public function login($request)
    {
        $user = $this->users->findByEmail($request->email);

        if ($user) {
            if (Hash::check($request->password, $user->password)) {
                $token = $user->createToken('Laravel Password Grant Client')->accessToken;
                $response = ['token' => $token];
                return (['response' => $response, 'code' => 200]);
            } else {
                $response = ["message" => "Password mismatch"];
                return (['response' => $response, 'code' => 422]);
            }
        } else {
            $response = ["message" =>'User does not exist'];
            return (['response' => $response, 'code' => 422]);
        }
    }
}
