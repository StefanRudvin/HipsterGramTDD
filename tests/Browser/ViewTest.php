<?php

namespace Tests\Browser;

use Tests\DuskTestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class ViewTest extends DuskTestCase
{   
    use DatabaseMigrations;
    /**
     * @test
     * @group view
     */
    public function index()
    {
        $this->browse(function ($browser) {
            $browser->visit('/')
                    ->assertSee('HipsterGram')
                    ->assertSee('Log In')
                    ->assertTitle('HipsterGram')
                    ->assertPathIs('/');
        });
    }

    /**
     * @test
     * @group view
     */
    public function Login()
    {
        $this->browse(function ($browser) {
            $browser->visit('/login')
                    ->assertSee('Log in')
                    ->assertSee('Register')
                    ->assertVisible('Email')
                    ->assertVisible('Password')
                    ->assertSeeLink('Login');
        });
    }

    /**
     * @test
     * @group view
     */
    public function Register()
    {
        $this->browse(function ($browser) {
            $browser->visit('/register')
                    ->assertSee('Login')
                    ->assertSee('Register')
                    ->assertSeeLink('Register');
        });
    }

}
