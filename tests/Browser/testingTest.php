<?php

namespace Tests\Browser;

use Tests\DuskTestCase;
use App\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\Browser\Pages\Login;

class testingTest extends DuskTestCase
{
    use DatabaseMigrations;

    /**
     * A Dusk test example.
     *
     * @return void
     * @group dusk
     */
    public function testExample()
    {
        $user = User::find(1);

        $this->browse(function ($browser) {
            $browser->loginAs($user)
                    ->visit('/')
                    ->assertSee('Laravel');
        });
    }


}
