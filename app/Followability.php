<?php

namespace App;
use Auth;

trait Followability {

	public function follows()
	{
		return $this->morphMany(Follow::class , 'followable');
	}

    public function follow(int $userId)
    {
    	$follow = new Follow(['user_id' => $userId]);

    	return $this->follows()->save($follow);
    }

    public function isFollowed(int $userId)
    {
    	return !! $this->follows()
    					->where('user_id', $userId)
    					->count();
    }
    
    public function unfollow(int $userId)
    {
    	return $this->follows()->where('user_id', $userId)->delete();
    }

    public function toggleFollow(int $userId)
    {
    	if ($this->isFollowed($userId)) {
    		return $this->unfollow($userId);
    	}
    	return $this->follow($userId);
    }

    public function followsCount()
    {
    	return $this->follows()->count();
    }

}