<?php

namespace App\Providers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use App\Models\User;
use App\Models\Notification;
use App\Repositories\PostRepository;
use App\Repositories\PostRepositoryInterface;
use Carbon\Carbon;
use App\Services\AuthService;
use App\Services\AuthInterface;
use App\Repositories\UserRepository;
use App\Repositories\UserRepositoryInterface;
use App\Services\PostService;
use App\Services\PostServiceInterface;

class AppServiceProvider extends ServiceProvider
{
    
    public function register()
    {
        $this->app->bind(AuthInterface::class, AuthService::class);
        $this->app->bind(UserRepositoryInterface::class, UserRepository::class);
        $this->app->bind(PostServiceInterface::class, PostService::class);
        $this->app->bind(PostRepositoryInterface::class, PostRepository::class);
    }


    public function boot()
    {
        // Share users data with the sidebar view
        View::composer('layouts.app', function ($view) {
            if (auth()->check()) {
                $notifications = auth()->user()->notifications()->orderByDesc('created_at')
                    ->where('created_at', '>', Carbon::now()->subHours(24))
                    ->get();
            } else {
                $notifications = [];
            }

            $user_id = Auth::id();
            $users = User::inRandomOrder()->paginate(11)->whereNotIn('id', [$user_id]);
            $view->with(['users'=> $users,'notifications' => $notifications]);
        });

        
    }
}
