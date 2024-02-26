<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Composer;
use Illuminate\Support\Facades\Auth;


class PostController extends Controller
{
    public function viewPost()
    {

    }
    public function showUserPosts(User $user)
    {
        $posts = $user->posts()->orderByDesc('created_at')->get();
        return view('profiles.Myposts', compact('posts', 'user'));
    }

    public function updatePost(Post $post)
    {
        return view('main.update', compact('post'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'content' => 'required',
            'cover' => 'nullable|mimes:jpeg,png,jpg,gif|file|max:2048',
        ]);

        $data['user_id'] = Auth::user()->id;

        if ($request->hasFile('cover')) {
            $imagePath = $request->file('cover')->store('uploads', 'public');
            $data['cover'] = $imagePath;
        }

        Post::create($data);
        return redirect(route('index'))->withSuccess('Successfully made post!');
    }
    public function update(Request $request, Post $post)
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

        $post->update($data);
        return redirect(route('index'))->withSuccess('Successfully updated post!');
    }

    public function destroy(Post $post)
    {
        if ($post->user->id === Auth::user()->id) {
            $post->delete();
            return redirect(route('index'))->withSuccess('Post deleted successfully!');
        } else {
            return redirect(route('index'))->withError('You are not authorized to delete this post!');
        }
    }
}