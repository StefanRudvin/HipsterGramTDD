<?php

namespace Tests\Browser;

use Tests\DuskTestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\Browser\Pages\Post;

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
                    ->visit('/new')
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
     */
    public function it_can_edit_own_post()
    {
        $this->browse(function ($browser) {
            $user = User::find(1);
            $post = createPost(['user_id' => $user->id, 'title' => 'factoryPost']);
            $browser->loginAs($user)
                    ->goToPost()
                    ->type('title', 'This post has been edited')
                    ->press('Post')
                    ->assertSee('Edit successful.')
                    ->assertSee('This post has been edited');
        });
    }

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

    public function it_cannot_edit_someone_elses_post()
    {
        $this->browse(function ($browser) {
            $user = User::find(1);
            $post = createPost(['user_id' => 2, 'title' => 'factoryPost']);
            $browser->loginAs($user)
                    ->visit('/{{ $user->id }}/posts/ {{ $post->id }} ')
                    ->assertSee('factoryPost')
                    ->assertNotSee('Edit');
        });
    }

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
