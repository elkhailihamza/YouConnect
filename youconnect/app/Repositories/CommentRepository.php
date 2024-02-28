<?php

namespace App\Repositories;

use App\Models\Comment;

class CommentRepository implements CommentRepositoryInterface
{
    public function getComments($post)
    {
        return Comment::select('users.name', 'users.avatar', 'comments.post_id', 'comments.content', 'comments.created_at')
            ->join('users', 'comments.user_id', '=', 'users.id')
            ->where('post_id', $post->id)
            ->orderBy('comments.created_at', 'DESC')
            ->paginate(10);
    }
    public function store($data)
    {
        Comment::create($data);
        return Comment::select('users.name', 'users.avatar', 'comments.post_id', 'comments.content', 'comments.created_at')
            ->join('users', 'comments.user_id', '=', 'users.id')->latest()->first();
    }
}