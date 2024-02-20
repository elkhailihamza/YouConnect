<?php
namespace App\Http\Controllers;

use App\Models\Like;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LikeController extends Controller
{
    public function store(Request $request)
    {
        $like = Like::firstOrCreate([
            'user_id' => auth()->id(),
            'post_id' => $request->post_id,
        ]);

        return response()->json(['status' => 'liked', 'like' => $like]);
    }

    public function destroy(Request $request)
    {
        $like = Like::where('user_id', auth()->id())
            ->where('post_id', $request->post_id)
            ->first();

        if ($like) {
            $like->delete();
            return response()->json(['status' => 'unliked']);
        }

        return response()->json(['status' => 'error']);
    }

    public function checkLike(Post $post)
    {
        $hasLiked = $post->likes()->where('user_id', auth()->id())->exists();

        return response()->json(['hasLiked' => $hasLiked]);
    }
}
