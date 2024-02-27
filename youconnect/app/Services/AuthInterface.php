<?php

namespace App\Services;

interface AuthInterface
{
    public function register(array $userData);
    public function login(array $credentials);
    public function logout();
}
