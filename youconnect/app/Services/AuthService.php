<?php

namespace App\Services;

use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use App\Repositories\UserRepositoryInterface;

class AuthService implements AuthInterface
{
    protected $userRepository;

    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function register(array $userData)
    {
        $validatedData = $this->validateRegistrationData($userData);
        $user = $this->userRepository->create($validatedData);
        return $user;
    }

    public function login(array $credentials)
    {
        if (Auth::attempt($credentials)) {
            return Auth::user();
        }

        throw ValidationException::withMessages([
            'email' => __('auth.failed'),
        ]);
    }

    public function logout()
    {
        Auth::logout();
    }

    protected function validateRegistrationData(array $data)
    {
        return validator($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8'],
        ])->validate();
    }

    protected function validateLoginCredentials(array $credentials)
    {
        return validator($credentials, [
            'email' => ['required', 'email'],
            'password' => ['required'],
        ])->validate();
    }
}
