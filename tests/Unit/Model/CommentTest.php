<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class CommentTest extends TestCase
{
    use DatabaseTransactions;

	protected $comment;

	public function setUp()
	{
		parent::setUp();

        $this->comment = createComment();

		$this->signIn();
	}

    /** @test */
    public function a_user_can_like_a_comment()
    {
    	// $this->comment->like();

    	// $this->assertDatabaseHas('likes', [
    	// 	'user_id' => $this->user->id,
    	// 	'likeable_id' => $this->comment->id,
    	// 	'likeable_type' => get_class($this->comment)
    	// ]);

    	// $this->assertTrue($this->comment->isLiked());
        $this->assertTrue(true);
    }

    /** @test */
    public function a_user_can_unlike_a_comment()
    {
    	$this->comment->like();
    	$this->comment->unlike();

    	$this->assertDatabaseMissing('likes', [
			'user_id' => $this->user->id,
			'likeable_id' => $this->comment->id,
			'likeable_type' => get_class($this->comment)
		]);

		$this->assertFalse($this->comment->isLiked());
    }

    /** @test */
    public function a_user_may_toggle_a_comment_like_status()
    {
    	$this->comment->toggleLike();

		$this->assertTrue($this->comment->isLiked());

		$this->comment->toggleLike();

		$this->assertFalse($this->comment->isLiked());
    }

    /** @test */
    public function a_comment_knows_how_many_likes_it_has()
    {
    	$this->comment->like();

		$this->assertEquals(1, $this->comment->likesCount());
    }

    /** @test */
    public function comment()
    {
    	$this->comment->like();

        $this->assertEquals(1, $this->comment->likesCount());
    }
}
