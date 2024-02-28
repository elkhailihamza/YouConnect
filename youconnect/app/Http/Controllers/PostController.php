<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Post;
use App\Services\PostServiceInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class PostController extends Controller
{
    protected $postService;
    public function __construct(PostServiceInterface $postService)
    {
        $this->postService = $postService;
    }
    public function viewPost(Post $post)
    {
        $posts = $this->postService->getPostById($post->id);
        return view('main.index', ['posts' => $posts, 'userId' => $posts[0]->user_id]);
    }

    public function updatePost(Post $post)
    {
        return view('main.update', compact('post'));
    }

    public function store(Request $request)
    {
        $data = $this->postService->validate(null, $request);
        $data['user_id'] = Auth::id();
        $this->postService->create($data);
        return redirect(route('index'))->withSuccess('Successfully made post!');
    }
    public function update(Request $request, Post $post)
    {
        $data = $this->postService->validate($post, $request);
        $this->postService->update($post, $data);
        return redirect(route('index'))->withSuccess('Successfully updated post!');
    }

    public function destroy(Post $post)
    {
        if ($post->user->id === Auth::user()->id) {
            $this->postService->delete($post);
            return redirect(route('index'))->withSuccess('Post deleted successfully!');
        } else {
            return redirect(route('index'))->withError('You are not authorized to delete this post!');
        }
    }
}
