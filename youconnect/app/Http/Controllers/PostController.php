<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    public function createPost()
    {
        return view('main.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required',
            'content' => 'required',
            'cover' => 'nullable|mimes:jpeg,png,jpg,gif|file|max:2048',
        ]);

        $data['user_id'] = Auth::user()->id;

        if ($request->hasFile('cover')) {
            $imagePath = $request->file('cover')->store('uploads', 'public');
            $data['cover'] = $imagePath;
        }

        Post::create($data);
        return redirect(route('main.posts'))->withSuccess('Successfully made post!');
    }

    public function edit(Post $post)
    {
        return view('main.post.edit', ['post' => $post]);
    }

    public function index()
    {
        $posts = Post::all();
        $users = User::inRandomOrder()->get();

        return view('main.index', compact('posts','users'));
    }

    public function update(Request $request, Post $post)
    {
        $data = $request->validate([
            'title' => 'required',
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
        return redirect(route('main.posts'))->withSuccess('Successfully updated post!');
    }

    public function destroy(Post $post)
    {
        $post->delete();
        return redirect(route('main.posts'))->withSuccess('Deleted successfully!');
    }
}
