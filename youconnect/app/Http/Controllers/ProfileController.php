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
        $user = User::where('id', $user->id)->first();
        return view('profiles.profile', compact('user'));
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
        return view('main.index', ['posts' => $posts, 'userId' => $user->id]);
    }
    
}
