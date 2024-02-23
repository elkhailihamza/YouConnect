<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use App\Models\Post;
use App\Models\Friendship;




class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    public function posts()
    {
        return $this->hasMany(Post::class);
    }
    
    public function sendRequest(User $friend)
{
    Friendship::create([
        'sender_id' => $this->id,
        'receiver_id' => $friend->id,
        'status_id' => 1, // En attente
    ]);
}

    
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    

    public function friendships()
    {
        return $this->hasMany(Friendship::class, 'sender_id');
    }
    
    public function receivedFriendRequests()
{
    return $this->hasMany(Friendship::class, 'receiver_id')->where('status_id', '1');
}

    
    public function friends()
    {
        return $this->belongsToMany(User::class, 'friendships', 'sender_id', 'receiver_id')
            ->wherePivot('status_id', 2); // 2 pour statut 'accepted'
    }

    public function hasSentFriendRequestTo(User $user)
    {
        return $this->sentFriendRequests()->where('receiver_id', $user->id)->exists();
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
        'name',
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
