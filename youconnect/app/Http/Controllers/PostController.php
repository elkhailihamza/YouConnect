<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Composer;
use Illuminate\Support\Facades\Auth;


class PostController extends Controller
{
    public function index()
    {
        return view('index', compact('posts'));
    }


    public function showUserPosts(User $user)
    {
        $posts = $user->posts()->orderByDesc('created_at')->get();
        return view('profiles.Myposts', compact('posts', 'user'));
    }
    



    public function view(Post $post)
    {
        return view('main.view', compact('post','users'));
    }
    public function createPost()
    {
        return view('main.create');
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