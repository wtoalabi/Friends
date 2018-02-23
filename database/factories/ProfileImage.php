<?php

use Faker\Generator as Faker;
use App\Models\Images\ProfileImage;

$factory->define(ProfileImage::class, function (Faker $faker) {
    return [
        'user_id'  => 1,
        'path'  => 'default.jpg',
    ];
});
