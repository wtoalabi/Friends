<?php

namespace Tests\Browser\User;

use App\User;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class LoginTest extends DuskTestCase
{
    //use DatabaseMigrations; //39secs
    //use DatabaseTransactions;
    //use RefreshDatabase;
    /**
     * A basic browser test example.
     *
     * @return void
     */
    public function testUserLogin()
    {
        $user = factory(User::class)->create();

        $this->browse(function ($browser) use ($user) {
            $browser->visit('/login')
                    ->type('email', $user->email)
                    ->type('password', 'secret')
                    ->press('Login')
                    ->assertPathIs('/home')
                    ->assertSee('Dashboard');
        });
        $user->delete();
        
        
    }
}
