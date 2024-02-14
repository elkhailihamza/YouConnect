<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Friendship extends Model
{
    use HasFactory;
    public function users()
    {
        return $this->belongsToMany(User::class, 'friendships', 'sender_id', 'receiver_id')
        ->withPivot('status')
        ->withTimestamps();
    }
}
