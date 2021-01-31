<?php

namespace App\Http\Repository;

use App\User;

class UserRepository
{
    public function create($input)
    {
        return User::create($input);
    }

    public function findByEmail($email)
    {
        return User::where('email', $email)->firstOrFail();
    }
}
