<?php

namespace App\Services;

interface CommentServiceInterface
{
    public function getComments($post);
    public function store(array $data);
}