<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use Likeability;

    protected $fillable = [
        'title', 'content', 'score'
    ];

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function comments()
    {
        return $this->hasMany('App\Comment');
    }

    public function oldpath()
    {
        return '/Posts/' . $this->id;
    }
}
