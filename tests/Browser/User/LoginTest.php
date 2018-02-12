<?php

namespace Tests\Browser\User;


use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use App\Models\Users\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
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
                    ->type('password', '12')
                    ->press('Login')
                    ->assertPathIs('/home')
                    ->assertSee('My Stream');
        });
        $user->delete();
        
        
    }
}
