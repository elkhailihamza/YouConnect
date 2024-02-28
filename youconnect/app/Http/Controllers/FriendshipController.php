<?php

namespace App\Http\Controllers;

use App\Models\Friendship;
use App\Models\Notification;
use App\Models\User;
use App\Notifications\FriendRequestNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FriendshipController extends Controller
{
    public function sendRequest(User $friend)
    {
        $found = Friendship::where('sender_id', Auth::user()->id)
            ->where('receiver_id', $friend->id)
            ->first();

        if (!$found) {
            auth()->user()->sendRequest($friend);

            $message = $friend->name . " You Have friend request from ".auth()->user()->name;

        Notification::create([
            'user_id' => $friend->id,
            'liker_id' => auth()->user()->id,
            'message' => $message,
        ]);
            return response()->json(['success' => 'Demande d\'ami envoyée avec succès']);
        } else {
            return response()->json(['error' => 'User already sent a friend request!']);
        }
    }

    public function acceptRequest(Friendship $friendship)
    {
        $friendship->update(['status_id' => '2']);

        return redirect()->back()->with('success', 'Friend request accepted');
    }

    public function rejectRequest(Friendship $friendship)
    {
        $friendship->update(['status_id' => '3']);

        return redirect()->back()->with('success', 'Friend request rejected');
    }


    public function sentRequests()
{
    $sentRequests = auth()->user()->sentFriendRequests()->where('status_id', '1')->get();

        return view('profiles.friendrequest', compact('sentRequests'));
    }


    public function cancelRequest(User $friend)
    {
        $found = Friendship::where('sender_id', Auth::user()->id)
            ->where('receiver_id', $friend->id)
            ->first();

        if ($found) {
            $found->delete();
            return response()->json(['success' => 'Removed pending request!']);
        } else {
            return response()->json(['error' => 'Friend request no found!']);
        }

    }


    public function receivedRequests()
    {
        $receivedRequests = auth()->user()->receivedFriendRequests()->get();
        $unreadRequestsCount = $receivedRequests->count();

        return view('profiles.friendrequest', compact('receivedRequests'));
    }


    public function showFriends()
{
    $user = auth()->user();
    $friends = User::whereHas('friendships', function ($query) use ($user) {
        $query->where('status_id', 2)
            ->where(function ($q) use ($user) {
                $q->where('sender_id', $user->id)
                    ->orWhere('receiver_id', $user->id);
            });
    })->get();

    return view('profiles.friends', compact('friends'));
}

public function deleteFriend(User $friend)
{
    $user = auth()->user();

    $friendship = Friendship::where(function ($query) use ($user, $friend) {
        $query->where('sender_id', $user->id)
            ->where('receiver_id', $friend->id);
    })->orWhere(function ($query) use ($user, $friend) {
        $query->where('sender_id', $friend->id)
            ->where('receiver_id', $user->id);
    })->first();

    if ($friendship) {
        $friendship->delete();
        return redirect()->back()->with('success', 'Friend removed successfully');
    } else {
        return redirect()->back()->with('error', 'Friend not found');
    }
}



}
