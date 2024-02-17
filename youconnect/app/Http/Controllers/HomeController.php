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
        $user_id = Auth::id();
        $users = User::inRandomOrder()->paginate(10)->whereNotIn('id', [$user_id]);
        $posts = Post::all();
        return view('index', compact(['users', 'posts']));
    }
}
