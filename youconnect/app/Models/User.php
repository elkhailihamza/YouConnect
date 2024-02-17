<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    public function sentMessages()
    {
        return $this->hasMany(Message::class, 'sender_id')->withPivot('content')->withTimestamps();
    }
    
    public function receivedMessages()
    {
        return $this->hasMany(Message::class, 'receiver_id')->withPivot('content')->withTimestamps();
    }
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function conversations()
{
    return $this->belongsToMany(Conversation::class, 'conversation_user', 'user_id', 'conversation_id');
}
    public function posts()
    {
        return $this->hasMany(Post::class);
    }
    public function friendships()
    {
        return $this->belongsToMany(Friendship::class, 'friendships', 'sender_id', 'receiver_id')
        ->withPivot('status')
        ->withTimestamps();
    }
    public function likes() {
        return $this->hasMany(Like::class);
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'username',
        'email',
        'password',
        'avatar',
        'bio',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];
}
