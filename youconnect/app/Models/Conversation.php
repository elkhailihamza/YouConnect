<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Conversation extends Model
{
    use HasFactory;
    public function messages()
{
    return $this->hasMany(Message::class);
}

public function users()
{
    return $this->belongsToMany(User::class, 'conversation_user', 'conversation_id', 'user_id');
}
}
