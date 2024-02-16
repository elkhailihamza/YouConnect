<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $users = User::inRandomOrder()->get();
        $posts = Post::all();
        return view('index', compact(['users', 'posts']));
    }}
