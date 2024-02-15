<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function create()
    {
        return view('main.view');
    }
    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required',
            'content' => 'required',
            'cover' => 'nullable|mimes:jpeg,png,jpg,gif|file|max:2048',
        ]);

        Post::create($data);
        return redirect(route('main.post'))->withSuccess('Successfully made post!');
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
