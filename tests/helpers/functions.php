<?php

function createPost($attributes = []) 
{
	return factory(App\Post::class)->create($attributes);
} // Createpost(['title' => "maa"])

function createComment($attributes = []) 
{
	return factory(App\Comment::class)->create($attributes);
} // Createpost(['title' => "maa"])
