<?php

namespace App;

trait Likeability {

	public function likes()
	{
		return $this->morphMany(Like::class , 'likeable');
	}

    public function like(int $userId)
    {
    	$like = new Like(['user_id' => $userId]);

    	return $this->likes()->save($like);
    }

    public function isLiked(int $userId)
    {
    	return !! $this->likes()
    					->where('user_id', $userId)
    					->count();
    }

    public function unlike(int $userId)
    {
    	return $this->likes()->where('user_id', $userId)->delete();
    }

    /**
     * @param int|null $userId
     */
    public function toggleLike(int $userId)
    {
    	if ($this->isLiked($userId)) {
    		return $this->unlike($userId);
    	}
    	return $this->like($userId);
    }

    public function likesCount()
    {
    	return $this->likes()->count();
    }

}