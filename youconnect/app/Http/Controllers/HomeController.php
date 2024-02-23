<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index()
    {
        $posts = Post::inRandomOrder()->paginate(10);
        return view('main.index', ['posts' => $posts]);
    }

    public function getUsers(Request $request)
    {
        $search = $request->input('search');
        $mainUserId = Auth::id();
        $users = User::where('name', 'LIKE', "%{$search}%")
            ->whereNotIn('friendships', function ($query) use ($mainUserId) {
                $query->where(function ($q) use ($mainUserId) {
                    $q->where('sender_id', $mainUserId)
                        ->orWhere('receiver_id', $mainUserId);
                });
            })
            ->paginate(20);

        return response()->json(['users' => $users]);
    }
}
