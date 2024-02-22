<?php

namespace App\Http\Controllers;

use App\Models\Friendship;
use App\Models\User;
use App\Notifications\FriendRequestNotification;
use Illuminate\Http\Request;

class FriendshipController extends Controller
{
    public function sendRequest(User $friend)
    {
        auth()->user()->sendRequest($friend);

    
        return redirect()->back()->with('success', 'Demande d\'ami envoyée avec succès');
    }

    public function acceptRequest(Friendship $friendship)
    {
        $friendship->update(['status' => 'accepted']);

        return redirect()->back()->with('success', 'Friend request accepted');
    }

    public function rejectRequest(Friendship $friendship)
    {
        $friendship->update(['status' => 'rejected']);

        return redirect()->back()->with('success', 'Friend request rejected');
    }


    public function sentRequests()
{
    $sentRequests = auth()->user()->sentFriendRequests()->where('status', 'pending')->get();

    return view('friendships.sent_requests', compact('sentRequests'));
}


public function cancelRequest(Friendship $friendship)
{
    $friendship->delete();

    return redirect()->back()->with('success', 'Demande d\'ami annulée avec succès');
}

}
