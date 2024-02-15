<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Composer;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::all();
        return view('main.index', compact('posts'));
    }
    public function view(Post $post)
    {
        return view('main.view', compact('post'));
    }
    public function create()
    {
        return view('main.create');
    }
    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required',
            'user_id' => 'required',
            'content' => 'required',
            'cover' => 'nullable|mimes:jpeg,png,jpg,gif|file|max:2048',
        ]);

        $data['user_id'] = Auth::user();

        if ($request->hasFile('cover')) {
            $imagePath = $request->file('cover')->store('uploads', 'public');
            $data['cover'] = $imagePath;
        }


        $data['user_id'] = Auth::user()->id;
        Post::create($data);
        return redirect(route('main.posts'))->withSuccess('Successfully made post!');
    }
    public function edit(Post $post)
    {
        return view('main.post.edit', ['post' => $post]);
    }
    public function update(Request $request, Post $post)
    {
        $data = $request->validate([
            'title' => 'required',
            'content' => 'required',
            'cover' => 'nullable|mimes:jpeg,png,jpg,gif|file|max:2048',
        ]);

        if ($request->hasFile('book_cover')) {
            if ($post->cover && file_exists(storage_path('app/public/' . $post->cover))) {
                unlink(storage_path('app/public/' . $post->cover));
            }
            $imagePath = $request->file('book_cover')->store('uploads', 'public');
            $data['cover'] = $imagePath;
        }

        $post->update($data);
        return redirect(route('main.post'))->withSuccess('Successfully updated post!');
    }
    public function destroy(Post $post)
    {
        $found = Post::find($post);
        if (!$found) {
            return redirect(route('main.post'))->withErrors('Post was not found!');
        }

        $post->delete();
        return redirect(route('main.post'))->withErrors('Deleted successfully!');
    }
}
