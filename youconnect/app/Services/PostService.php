<?php

namespace App\Services;

use App\Repositories\PostRepositoryInterface;

class PostService implements PostServiceInterface
{
    protected $postRepository;
    public function __construct(PostRepositoryInterface $postRepository)
    {
        $this->postRepository = $postRepository;
    }
    public function getAllPosts()
    {
        return $this->postRepository->getAllPosts();
    }
    public function getPostsByUserId($userId)
    {
        return $this->postRepository->getPostsByUserId($userId);
    }
    public function getPostById($postId)
    {
        return $this->postRepository->getPostById($postId);
    }
    public function validate($post = null, $request)
    {
        $data = $request->validate([
            'content' => 'required',
            'cover' => 'nullable|mimes:jpeg,png,jpg,gif|file|max:2048',
        ]);

        if ($request->hasFile('cover')) {
            if ($post->cover && file_exists(storage_path('app/public/' . $post->cover))) {
                unlink(storage_path('app/public/' . $post->cover));
            }
            $imagePath = $request->file('cover')->store('uploads', 'public');
            $data['cover'] = $imagePath;
        }

        return $data;
    }
    public function create(array $data)
    {
        return $this->postRepository->create($data);
    }
    public function update($post, array $data)
    {
        return $this->postRepository->update($post, $data);
    }
    public function delete($post)
    {
        return $this->postRepository->delete($post);
    }
}
