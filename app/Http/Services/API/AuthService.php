<?php


namespace App\Http\Services\API;


use App\User;
use Illuminate\Support\Facades\Hash;

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

    public function login($request)
    {
        $user = User::where('email', $request->email)->firstOrFail();

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
