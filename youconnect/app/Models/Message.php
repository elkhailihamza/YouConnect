<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    use HasFactory;
    public function users() {
        return $this->belongsToMany(User::class, 'sender_id', 'receiver_id')
        ->withPivot('content')
        ->withTimestamps();
    }
}
