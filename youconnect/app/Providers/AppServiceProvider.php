<?php

namespace App\Providers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use App\Models\User;

class AppServiceProvider extends ServiceProvider
{
    public function register()
    {
        //
    }

    public function boot()
    {
        // Share users data with the sidebar view
        View::composer('layouts.app', function ($view) {
            $user_id = Auth::id();
            $users = User::inRandomOrder()->paginate(15)->whereNotIn('id', [$user_id]);
            $view->with('users', $users);
        });
    }
}
