<?php

use App\Models\Users\User;
use Faker\Generator as Faker;
use App\Models\Statuses\Status;

$factory->define(Status::class, function (Faker $faker) {
   // $user = factory(User::class)->create();
    return [
    'user_id'  => 1,
    'mood_id'  => 1,
    'profile_id'  => 1,
    'created_at'=>$faker->dateTimeThisMonth(),
    'body' => $faker->sentence
    ];
});
