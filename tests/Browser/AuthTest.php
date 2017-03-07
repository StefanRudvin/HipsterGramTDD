<?php

namespace Tests\Browser;

use Tests\DuskTestCase;
use App\User;
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
                    ->assertSee('You are logged in!')
                    ->assertSee($user->name);
        });
    }

    /**
     * @test
     * @group auth
     */
    public function register()
    {
        $this->browse(function ($browser) {
            $browser->visit('/register')
                    ->type('name', 'hammas')
                    ->type('email', 'hammas@hammas.com')
                    ->type('password', 'secret')
                    ->type('password_confirmation', 'secret')
                    ->press('Register')
                    ->assertPathIs('/home')
                    ->assertSee('You are logged in!');
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
                  ->visit('/logout')
                  ->assertSee('Laravel');
        });
    }
}
