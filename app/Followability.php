<?php

namespace App;
use Auth;

trait Followability {

	public function follows()
	{
		return $this->morphMany(Follow::class , 'followable');
	}

    public function follow()
    {
    	$follow = new Follow(['user_id' => Auth::id()]);

    	$this->follows()->save($follow);
    }

    public function isFollowed()
    {
    	return !! $this->follows()
    					->where('user_id', Auth::id())
    					->count();
    }
    
    public function unfollow()
    {
    	$this->follows()->where('user_id', Auth::id())->delete();
    }

    public function toggleFollow()
    {
    	if ($this->isFollowed()) {
    		return $this->unfollow();
    	}
    	return $this->follow();
    }

    public function followsCount()
    {
    	return $this->follows()->count();
    }

}