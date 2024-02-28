<?php

namespace App\Services;

use App\Repositories\PostRepository;


interface PostServiceInterface
{
    public function getAllPosts();
    public function getPostsByUserId($userId);
    public function getPostById($postId);
    public function validate($post = null, $request);
    public function create(array $data);
    public function update($post, array $data);
    public function delete($post);
}