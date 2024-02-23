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
        $users = User::where('name', 'LIKE', "%{$search}%")->paginate(20);
        if (Auth::check()) {
            $currentUser = Auth::user();
            return response()->json(['users' => $users, 'mainUserId' => $currentUser->id, 'search' => $search]);
        } else {
            return response()->json(['users' => $users, 'search' => $search]);
        }

    }
}
