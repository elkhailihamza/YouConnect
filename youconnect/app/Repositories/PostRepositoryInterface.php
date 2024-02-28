<?php

namespace App\Repositories;

interface PostRepositoryInterface
{
    public function getAllPosts();
    public function getPostsByUserId($id);
    public function getPostById($id);
    public function create(array $data);
    public function update($post, array $data);
    public function delete($post);
}