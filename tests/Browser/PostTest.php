<?php

namespace Tests\Browser;

use Tests\DuskTestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class PostTest extends DuskTestCase
{
    use DatabaseMigrations;

    protected $user;
    protected $post;

    public function setUp()
    {
        parent::setUp();

        $this->post = createComment();

        $this->signIn();
    }

    /**
     * @test
     * @group Post
     */
    public function it_can_create_new_post()
    {
        $this->browse(function ($browser) {
            $browser->visit('/new')
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
            $browser->visit('/' + $this->user->id + '/' + 'posts/' + $this->post->id)
                    ->assertSee('factoryPost')
                    ->press('factoryPost')
                    ->press('Edit')
                    ->type('title', 'This post has been edited')
                    ->press('Post')
                    ->assertSee('Edit successful.')
                    ->assertSee('This post has been edited');
        });
    }

}
