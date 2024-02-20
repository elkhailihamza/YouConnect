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
        $posts = Post::all()->sortByDesc('created_at');
        return view('main.index', compact(['posts']));
    }
}
