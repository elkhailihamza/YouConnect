<?php

namespace App\Services;

use App\Repositories\CommentRepositoryInterface;

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
    public function store($data)
    {
        return $this->commentRepository->store($data);
    }
}