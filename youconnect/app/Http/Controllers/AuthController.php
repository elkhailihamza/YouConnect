<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\AuthInterface;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    protected $authService;

    public function __construct(AuthInterface $authService)
    {
        $this->authService = $authService;
    }

    public function showRegister()
    {
        return view('auth.register');
    }

    public function register(Request $request)
{
    $user = $this->authService->register($request->all());
    Auth::login($user);
    return redirect()->route('index')->withSuccess('Registration successful!');
}

    public function showLogin()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if ($this->authService->login($credentials)) {
            return redirect()->intended(route('index'))->withSuccess('Login successful!');
        }

        return back()->withError('Login unsuccessful try again!');
    }

    public function logout(Request $request)
    {
        $this->authService->logout();
        $request->session()->invalidate();
        return redirect(route('index'))->withSuccess('Successfully logged out!');
    }
}
