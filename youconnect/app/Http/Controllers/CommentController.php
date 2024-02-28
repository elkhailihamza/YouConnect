<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Notification;
use App\Models\Post;
use App\Services\CommentServiceInterface;
use App\Services\NotificationServiceInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    protected $notificationService;
    protected $commentService;
    public function __construct(CommentServiceInterface $commentService, NotificationServiceInterface $notificationService)
    {
        $this->commentService = $commentService;
        $this->notificationService = $notificationService;

    }
    public function index(POST $post)
    {
        $comments = $this->commentService->getComments($post);
        return response()->json(['comments' => $comments]);
    }
    public function store(Request $request, $postId)
    {
        try {
            $comment = $this->commentService->store($request, $postId);

            $post = Post::find($postId);
            $username = auth()->user()->name;
            $message = "$username commented on your '$post->content' post";

            $this->notificationService->store([
                'user_id' => $post->user_id,
                'liker_id' => auth()->user()->id,
                'post_id' => $postId,
                'message' => $message,
            ]);

            $comments = Comment::where('post_id', $postId)->get();

            return response()->json(['message' => 'success', 'comment' => $comment, 'count' => $comments->count()]);
        } catch (\Exception $e) {
            return response()->json(['message' => 'error', 'error' => $e->getMessage()], 500);
        }
    }
}
