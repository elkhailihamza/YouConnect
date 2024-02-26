<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Notification;
use App\Models\Post;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function index(POST $post)
    {
        $comments = Comment::select('users.name', 'users.avatar', 'comments.post_id', 'comments.content', 'comments.created_at')
            ->join('users', 'comments.user_id', '=', 'users.id')
            ->where('post_id', $post->id)
            ->orderBy('comments.created_at', 'DESC')
            ->paginate(10);
        return response()->json(['comments' => $comments]);
    }
    public function store(Request $request, $postId)
    {
        try {
            $request->validate([
                'content' => 'required|max:255',
            ]);

            Comment::create([
                'post_id' => $postId,
                'user_id' => auth()->user()->id,
                'content' => $request->input('content'),
            ]);

        $post = Post::find($postId);
        $username=auth()->user()->name;
        $message = "$username commented your poste '$post->content'";

        Notification::create([
        'user_id' => $post->user_id,
        'liker_id' => auth()->user()->id,
        'post_id' => $postId,
        'message' => $message,
        ]);

            $comments = Comment::where('post_id', $postId);
            $comment = Comment::select('users.name', 'users.avatar', 'comments.post_id', 'comments.content', 'comments.created_at')
            ->join('users', 'comments.user_id', '=', 'users.id')->latest()->first();

            return response()->json(['message' => 'success', 'comment' => $comment, 'count' => $comments->count()]);
        } catch (\Exception $e) {
            return response()->json(['message' => 'error', 'error' => $e->getMessage()], 500);
        }
    }
}
