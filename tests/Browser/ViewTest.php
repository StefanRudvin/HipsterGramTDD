<?php

namespace Tests\Browser;

use App\User;
use App\Post;
use Tests\DuskTestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class ViewTest extends DuskTestCase
{   
    use DatabaseMigrations;
    /**
     * @test
     * @group view
     */
    public function it_can_see_index_page()
    {
        $this->browse(function ($browser) {
            $browser->visit('/')
                    ->assertSee('HipsterGram')
                    ->assertSee('LOGIN')
                    ->assertTitle('HipsterGram')
                    ->assertPathIs('/');
        });
    }

    /**
     * @test
     * @group view
     */
    public function it_can_see_login_page()
    {
        $this->browse(function ($browser) {
            $browser->visit('/login')
                    ->assertSee('Login')
                    ->assertSee('Register')
                    ->assertSee('Remember')
                    ->assertSee('Password')
                    ->assertSeeLink('Login');
        });
    }

    /**
     * @test
     * @group view
     */
    public function it_can_see_register_page()
    {
        $this->browse(function ($browser) {
            $browser->visit('/register')
                    ->assertSee('Login')
                    ->assertSee('Register')
                    ->assertSeeLink('Register');
        });
    }

    /**
     * @test
     * @group view
     */
    public function it_can_see_profile_page()
    {
        $user = factory(User::class)->create([
            'email' => 'taylor@laravel.com',
        ]);

        $this->browse(function ($browser) use ($user){
            $browser->loginAs($user)
                    ->visit('/posts')
                    ->assertSee($user->name);
        });
    }

    /**
     * @test
     * @group view
     */
    public function it_can_see_feed()
    {
        $this->browse(function ($browser){
            $browser->loginAs(User::find(1))
                  ->visit('/home');
                  #->assertSee(Post::find(1));
        });
    }


}
