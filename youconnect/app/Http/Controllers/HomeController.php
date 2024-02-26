<?php

namespace App\Http\Controllers;

use App\Models\Friendship;
use App\Models\Post;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index()
    {

        if (auth()->check()) {
            $notifications = auth()->user()->notifications()
                ->where('created_at', '>', Carbon::now()->subHours(24))
                ->get();
        } else {
            $notifications = [];
        }
        $posts = Post::inRandomOrder()->paginate(10);
        return view('main.index', ['posts' => $posts, 'userId' => Auth::id(),'notifications' => $notifications
    ]);

        
    }

    public function getUsers(Request $request)
    {
        $search = $request->input('search');
        $mainUserId = Auth::id();
        $users = User::where('name', 'LIKE', "%{$search}%")
            ->paginate(20);

        $users->each(function ($user) use ($mainUserId) {
            $user->isFriend = Friendship::areFriends($mainUserId, $user->id);
            $user->pending = Friendship::isFriendRequestPending($mainUserId, $user->id);
        });

        return response()->json(['users' => $users]);
    }
}
