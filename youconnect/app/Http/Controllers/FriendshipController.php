<?php

namespace App\Http\Controllers;

use App\Models\Friendship;
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

        return view('profiles.friendrequest', compact('receivedRequests'));
    }


}
