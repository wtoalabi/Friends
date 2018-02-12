<?php

namespace Tests\Browser\User;

use App\User;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class RegistrationTest extends DuskTestCase
{
    //use RefreshDatabase;
    /**
     * A Dusk test example.
     *
     * @return void
     */
    public function testRegistration()
    {
        //$user = factory(User::class)->create();
        $user = User::where('email', 'test@test.com');
        $user->delete();

        $this->browse(function (Browser $browser) {
            $browser->visit('/register')
                    ->assertSee('Signup Page')
                    ->type('name', "TestName")
                    ->type('password', "secret")
                    ->type('password_confirmation', "secret")
                    ->type('email', "test@test.com")
                    ->attach('profileImage', __DIR__.'/photos/test.jpg')
                    ->press("Click to Register your Account");
                    $browser->whenAvailable('.swal2-popup', function ($modal) {
                        $modal->assertSee('You are welcome');
                    });
        });

    }
            public function testDashboard(){
                $this->browse(function (Browser $browser) {
                    $browser->assertSee("Dashboard")
                    ->assertSee("Home Page")
                    ->assertSee("My Stream")
                    ->assertSee("My Profile")
                    ->assertSee("TestName");
                });
                
            }
}
