<?php

namespace App\Http\Users;

use Intervention\Image\Facades\Image;

class Thumbnail {
    
    public static function make($file,$path){
        Image::make($file)
        ->fit(200)
        ->save($path);
    }
}