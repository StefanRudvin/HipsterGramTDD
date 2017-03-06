<?php

namespace Tests\Browser;

use Tests\DuskTestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class AuthTest extends DuskTestCase
{
    use DatabaseMigrations;
    /**
     * @test
     * @group auth
     */
    public function login()
    {
        $user = factory(User::class)->create([
            'email' => 'taylor@laravel.com',
        ]);

        $this->browse(function ($browser) use ($user) {
            $browser->visit('/login')
                    ->type('email', $user->email)
                    ->type('password', 'secret')
                    ->press('Login')
                    ->assertPathIs('/home')
                    ->assertSee('You have successfully logged in')
                    ->assertSee('Logout');
        });
    }

    /**
     * @test
     * @group auth
     */
    public function register()
    {
        $user = factory(User::class)->create([
            'email' => 'taylor@laravel.com',
        ]);

        $this->browse(function ($browser) use ($user) {
            $browser->visit('/register')
                    ->type('name', $user->name)
                    ->type('email', $user->email)
                    ->type('password', 'secret')
                    ->press('Register')
                    ->assertPathIs('/home')
                    ->assertSee('You have registered successfully');
        });
    }

    /**
     * @test
     * @group auth
     */
    public function logout()
    {
        $this->browse(function ($first) {
            $first->loginAs(User::find(1))
                  ->visit('/home')
                  ->press('Logout')
                  ->assertSee('You have successfully logged out.');
        });
    }
}
