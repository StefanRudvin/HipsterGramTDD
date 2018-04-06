<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use Likeability;

    protected $fillable = [
        'content', 'user_id', 'post_id'
    ];

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function post()
    {
        return $this->belongsTo('App\Post');
    }

    public function path()
    {
        return '/comments/' . $this->id;
    }
}
