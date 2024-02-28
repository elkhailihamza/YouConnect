<?php

namespace App\Repositories;

use App\Models\Post;
use App\Repositories\PostRepositoryInterface;

class PostRepository implements PostRepositoryInterface
{
    public function getAllPosts()
    {
        return Post::inRandomOrder()->paginate(10);
    }
    public function getPostsByUserId($id)
    {
        return Post::orderByDesc('created_at')->where('user_id', $id)->get();
    }
    public function getPostById($id)
    {
        return Post::orderByDesc('created_at')->where('id', $id)->get();
    }
    public function create(array $data)
    {
        return Post::create($data);
    }
    public function update($post, array $data)
    {
        return $post->update($data);
    }
    public function delete($post)
    {
        return $post->delete();
    }
}
