<?php


namespace App\Http\Services\API;


use App\User;

class AuthService
{
    public function register($request)
    {
        $input = $request->all();
        $input['password'] = bcrypt($input['password']);
        $user = User::create($input);
        $success['token'] =  $user->createToken('MyApp')->accessToken;
        $success['name'] =  $user->name;

        return $success;
    }

    public function login()
    {

    }
}
