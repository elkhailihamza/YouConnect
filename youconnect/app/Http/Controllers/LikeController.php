<?php

namespace App\Http\Controllers;

use App\Models\Like;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LikeController extends Controller
{
    public function store(Post $post)
    {
        $user_id = Auth::user()->id;

        Like::create([
            'post_id' => $post->id,
            'user_id' => $user_id,
        ]);
        
        return redirect(route('index'));
    }
}
