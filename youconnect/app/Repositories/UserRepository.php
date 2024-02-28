<?php


namespace App\Repositories;

use App\Models\User;

class UserRepository implements UserRepositoryInterface
{
    public function create(array $userData)
    {
        return User::create($userData);
    }

    public function findByEmail(string $email)
    {
        return User::where('email', $email)->first();
    }
}
