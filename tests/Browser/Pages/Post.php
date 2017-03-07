<?php

namespace Tests\Browser\Pages;

use Laravel\Dusk\Browser;
use Laravel\Dusk\Page as BasePage;
use App\User;
use App\Comment;

class Post extends BasePage
{
    /**
     * Get the URL for the page.
     *
     * @return string
     */
    public function url()
    {
        return '/';
    }

    /**
     * Assert that the browser is on the page.
     *
     * @return void
     */
    public function assert(Browser $browser)
    {
        $browser->assertPathIs($this->url());
    }

    /**
     * Get the element shortcuts for the page.
     *
     * @return array
     */
    public function elements()
    {
        return [
            '@element' => '#selector',
        ];
    }

    public function createPost($attributes = null)
    {
        return factory(App\Comment::class)->create($attributes);
    }

    public function goToPost()
    {
        $browser->visit('/{{ $user->id }}/posts/ {{ $post->id }} ')
                ->assertSee('factoryPost')
                ->press('factoryPost')
                ->press('Edit')
    }
}
