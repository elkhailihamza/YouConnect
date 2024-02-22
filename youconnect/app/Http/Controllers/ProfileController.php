<?php 

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function showuser(User $user)
    {
        $user = auth()->user(); 
        $posts = Post::all();
        return view('profiles.profile', compact('posts', 'user'));
    }

    public function edituser()
{
    $user = auth()->user();
    return view('profiles.edit', compact('user'));
}

public function updateuser(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'password' => 'nullable|string|min:8',
            'bio' => 'nullable|string|max:255',
            'avatar' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $user->name = $request->name;
        $user->email = $request->email;
        $user->bio = $request->bio;

        if ($request->has('password')) {
            $user->password = Hash::make($request->password);
        }

        if ($request->hasFile('avatar')) {
            $avatarPath = $request->file('avatar')->store('avatars', 'public');
            $user->avatar = $avatarPath;
        }

        $user->save();

        return redirect(route('profiles.profile', Auth::user()))->with('success', 'Profile updated successfully');
    }

    public function showUserPosts(User $user)
    {
        $posts = $user->posts()->orderByDesc('created_at')->get();
        return view('profiles.Myposts', compact('posts', 'user'));
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
