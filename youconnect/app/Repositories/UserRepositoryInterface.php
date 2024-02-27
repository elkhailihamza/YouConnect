<?php

namespace App\Repositories;

interface UserRepositoryInterface
{
    public function create(array $userData);
    public function findByEmail(string $email);
}
