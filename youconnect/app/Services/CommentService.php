<?php

namespace App\Services;

use App\Repositories\CommentRepositoryInterface;
use Illuminate\Support\Facades\Auth;

class CommentService implements CommentServiceInterface
{
    protected $commentRepository;
    public function __construct(CommentRepositoryInterface $commentRepository)
    {
        $this->commentRepository = $commentRepository;
    }
    public function getComments($post)
    {
        return $this->commentRepository->getComments($post);
    }
    public function store($request, $postId)
    {
        $data = $request->validate([
            'content' => 'required|max:255',
        ]);
        $data['post_id'] = $postId;
        $data['user_id'] = Auth::id();

        return $this->commentRepository->store($data);
    }
}