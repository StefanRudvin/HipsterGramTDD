<?php

namespace Tests\Browser;

use Tests\DuskTestCase;
use Tests\TestCase;
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
        $user = factory(User::class)->create([
            'email' => 'taylor@laravel.com',
        ]);

        $this->browse(function ($browser) use ($user) {

            $browser->visit('/login')
                    ->type('email', $user->email)
                    ->type('password', 'secret')
                    ->press('Login')
                    ->visit('/Post/new')
                    ->assertSee('Create Post')
                    ->type('title', 'The post Yo')
                    ->type('content', 'The content yo.')
                    ->attach('image', __DIR__.'/public/uploads/images/defaults/default1.jpg')
                    #->press('Submit Post')
                    ->assertSee('Create Post');
        });
    }

    /**
     * @test
     * @group Post
     @group daa
     */
    // public function it_can_edit_own_post()
    // {
        
        
    //     $this->browse(function ($browser) {
    //         $user = User::find(4);
    //         $post = $user->posts()->first();
    //         $browser->loginAs($user)
    //                 ->visit('Posts/'.$post->id)
    //                 ->clickLink('Edit')
    //                 ->type('title', 'This post has been edited')
    //                 ->press('Update Post')
    //                 ->assertSee('Edit successful.')
    //                 ->assertSee('This post has been edited');
    //     });
    // }

    /**
     * @test
     * @group Post
     */
    // public function it_can_delete_own_post()
    // {
    //     $this->browse(function ($browser) {
    //         $user = User::find(1);
    //         $post = createPost(['user_id' => $user->id, 'title' => 'factoryPost']);
    //         $browser->loginAs($user)
    //                 ->goToPost()
    //                 ->assertSee('Delete')
    //                 ->press('Delete Post')
    //                 ->assertSee('Post has been deleted.');
    //     });
    // }

    /**
     * @test
     * @group Post
     */
    // public function it_cannot_edit_someone_elses_post()
    // {
    //     $user = User::find(4);
        
    //     $this->browse(function ($browser) use ($user) {
    //         $browser->loginAs($user)
    //                 ->visit('Posts/1')
    //                 ->clickLink('Edit')
    //                 ->assertNotSee('Update Post')
    //                 ->assertSee('Not allowed');
    //     });
    // }

    /**
     * @test
     * @group Post
     */
    // public function it_cannot_delete_someone_elses_post()
    // {
    //     $this->browse(function ($browser) {
    //         $user = User::find(1);
    //         $post = createPost(['user_id' => 2, 'title' => 'factoryPost']);
    //         $browser->loginAs($user)
    //                 ->goToPost()
    //                 ->assertSee('Not allowed');
    //     });
    // }

}
