<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\models\Like;
use App\Models\Notification;
use App\Models\Post;

class LikeController extends Controller
{
    public function toggleLike(Request $request)
    {
        $postId = $request->input('post_id');
        $userId = auth()->user()->id;
        $userName = auth()->user()->name;

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

            $post = Post::find($postId);
            $message = "{$userName} a aimé votre poste '$post->content'";

            Notification::create([
                'user_id' => $post->user_id,
                'liker_id' => $userId,
                'post_id' => $postId,
                'message' => $message,
            ]);
            $liked = true;
        }
        $likesCount = Like::where('post_id', $postId)->count();

        return response()->json(['liked' => $liked, 'likesCount' => $likesCount]);
    }

}
