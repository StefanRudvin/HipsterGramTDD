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

        $this->browse(function ($browser) {

            $something = '/1';
            $user = User::find(1);


            $browser->loginAs($user)
                    ->visit('/{{$user->id}}')
                    ->assertSee('Laravel')
                    ->visit($something)
                    ->assertSee('Maa');
        });
    }


}
