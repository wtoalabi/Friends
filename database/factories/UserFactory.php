<?php

use App\Models\Users\User;
use Faker\Generator as Faker;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(User::class, function (Faker $faker) {
    static $password;

    return $user =  [
        'name' => $faker->firstName,
        'username' => $faker->word,
        'email' => $faker->unique()->safeEmail,
        'password' => $password ?: $password = '12',
        'remember_token' => str_random(10),
        'auth' => 0,
    ];
});
