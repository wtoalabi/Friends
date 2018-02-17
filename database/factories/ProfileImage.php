<?php

use Faker\Generator as Faker;
use App\Models\Images\ProfileImage;

$factory->define(ProfileImage::class, function (Faker $faker) {
    return [
        'user_id'  => 1,
        'path'  => 'images/22/1/thumb-NFqoszhC1DcvkzhtHtJl1518804721.jpg',
    ];
});
