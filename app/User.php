<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Auth;

class User extends Authenticatable
{
    use Notifiable;

    use Followability;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function posts()
    {
        return $this->hasMany('App\Post');
    }

    public function comments()
    {
        return $this->hasMany('App\Comment');
    }

    public function id()
    {
        return $this->user_id;
    }

    public function isAdmin()
    {
        return $this->is_admin;
    }

    public function getFollowedPosts()
    {
        $posts = Post::all();

        $userId = Auth::user()->id;

        $followedPosts = array();

        foreach ($posts as $post) {
            if ($post->user->isFollowed($userId)) {
                array_push($followedPosts, $post);
            }
        }

        return $followedPosts;
    }
}
