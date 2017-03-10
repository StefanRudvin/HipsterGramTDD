<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class LikesTest extends TestCase
{
    use DatabaseTransactions;

	protected $post;
	protected $user;

	public function setUp()
	{
		parent::setUp();

		#$this->post = factory(Post::class)->create();

		$this->post = createPost();

		// Implemented from TestCase.php
		$this->signIn();
	}

    /** @test */
    public function a_user_can_like_a_post()
    {
    	$this->post->like();

    	$this->assertDatabaseHas('likes', [
    		'user_id' => $this->user->id,
    		'likeable_id' => $this->post->id,
    		'likeable_type' => get_class($this->post)
    	]);

    	$this->assertTrue($this->post->isLiked());
    }

    /** @test */
    public function a_user_can_unlike_a_post()
    {
    	$this->post->like();
    	$this->post->unlike();

    	$this->assertDatabaseMissing('likes', [
			'user_id' => $this->user->id,
			'likeable_id' => $this->post->id,
			'likeable_type' => get_class($this->post)
		]);

		$this->assertFalse($this->post->isLiked());
    }

    /** @test */
    public function a_user_may_toggle_a_post_like_status()
    {
    	$this->post->toggleLike();

		$this->assertTrue($this->post->isLiked());

		$this->post->toggleLike();

		$this->assertFalse($this->post->isLiked());
    }

    /** @test */
    public function a_post_knows_how_many_likes_it_has()
    {
    	$this->post->like();

		$this->assertEquals(1, $this->post->likesCount());
    }

    /** @test */
    public function a_post_knows_how_many_comments_it_has()
    {
    	$this->post->like();

        $this->assertEquals(1, $this->post->likesCount());
    }

}
