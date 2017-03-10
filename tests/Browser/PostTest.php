<?php

namespace Tests\Browser;

use Tests\DuskTestCase;
use App\User;
use App\Post;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class PostTest extends DuskTestCase
{
    use DatabaseMigrations;

    /**
     * @test
     * @group Post
     */
    public function it_can_create_new_post()
    {
        $this->browse(function ($browser) {

            $browser->loginAs(User::find(1))
                    ->visit('/post/new')
                    ->assertSee('Create')
                    ->type('title', 'The post Yo')
                    ->type('content', 'The content yo.')
                    ->attach('image', __DIR__.'/photos/me.png')
                    ->press('Post')
                    ->assertSee('Your post has been created successfully.')
                    ->assertSee('The post Yo');
        });
    }

    /**
     * @test
     * @group Post
     @group daa
     */
    public function it_can_edit_own_post()
    {
        $user = User::find(4);
        
        $this->browse(function ($browser) use ($user) {
            $post = $user->posts()->first();
            $browser->loginAs($user)
                    ->visit('posts/'.$post->id)
                    ->clickLink('Edit')
                    ->type('title', 'This post has been edited')
                    ->press('Update Post')
                    ->assertSee('Edit successful.')
                    ->assertSee('This post has been edited');
        });
    }

    /**
     * @test
     * @group Post
     */
    public function it_can_delete_own_post()
    {
        $this->browse(function ($browser) {
            $user = User::find(1);
            $post = createPost(['user_id' => $user->id, 'title' => 'factoryPost']);
            $browser->loginAs($user)
                    ->goToPost()
                    ->assertSee('Delete')
                    ->press('Delete Post')
                    ->assertSee('Post has been deleted.');
        });
    }

    /**
     * @test
     * @group Post
     */
    public function it_cannot_edit_someone_elses_post()
    {
        $user = User::find(4);
        
        $this->browse(function ($browser) use ($user) {
            $browser->loginAs($user)
                    ->visit('posts/1')
                    ->clickLink('Edit')
                    ->assertNotSee('Update Post')
                    ->assertSee('Not allowed');
        });
    }

    /**
     * @test
     * @group Post
     */
    public function it_cannot_delete_someone_elses_post()
    {
        $this->browse(function ($browser) {
            $user = User::find(1);
            $post = createPost(['user_id' => 2, 'title' => 'factoryPost']);
            $browser->loginAs($user)
                    ->goToPost()
                    ->assertSee('Not allowed');
        });
    }

}
