<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Friendship extends Model
{
    protected $fillable = ['sender_id', 'receiver_id', 'status_id'];

    public function user()
    {
        return $this->belongsTo(User::class, 'sender_id');
    }
    public function sender()
    {
        return $this->belongsTo(User::class, 'sender_id');
    }

    public function receiver()
    {
        return $this->belongsTo(User::class, 'receiver_id');
    }

    public function status()
    {
        return $this->belongsTo(Status::class);
    }

    public static function areFriends($userId, $friendId)
    {
        return static::where(function ($query) use ($userId, $friendId) {
            $query->where('sender_id', $userId)
                ->where('receiver_id', $friendId);
        })->orWhere(function ($query) use ($userId, $friendId) {
            $query->where('sender_id', $friendId)
                ->where('receiver_id', $userId);
        })->exists();
    }
    public static function isFriendRequestPending($senderId, $receiverId)
    {
        return static::where('sender_id', $senderId)
            ->where('receiver_id', $receiverId)
            ->where('status_id', 1)
            ->exists();
    }
}
