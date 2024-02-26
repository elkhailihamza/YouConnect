<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\models\Like;
use App\Models\Post;
use App\Models\User;
use App\Notifications\PostLiked;
use Illuminate\Support\Composer;
use Illuminate\Support\Facades\Auth;

class LikeController extends Controller
{
    public function toggleLike(Request $request)
{
    $postId = $request->input('post_id');
    $userId = auth()->user()->id;

    $like = Like::where('post_id', $postId)
                ->where('user_id', $userId)
                ->first();

    if ($like) {
        $like->delete();
        $liked = false;
    } else {
        Like::create([
            'user_id' => $userId,
            'post_id' => $postId
        ]);
        $liked = true;

       
    }

    $likesCount = Like::where('post_id', $postId)->count();

    return response()->json(['liked' => $liked, 'likesCount' => $likesCount]);
}

}
