<?php

use Faker\Generator as Faker;
use App\Models\Statuses\Status;

$factory->define(Status::class, function (Faker $faker) {
    return [
    'user_id'  => 1,
    'mood_id'  => 1,
    'profile_id'  => 1,
    'slug'  => str_slug($faker->sentence($nbWords = 4)),
    'created_at'=>$faker->dateTimeThisMonth(),
    'body' => $faker->paragraph($nbSentences = 3)
    ];
});
