<?php

namespace App\Repositories;

interface CommentRepositoryInterface
{
    public function getComments($post);
    public function store(array $data);
}