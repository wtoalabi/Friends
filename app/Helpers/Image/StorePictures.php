<?php
namespace App\Helpers\Image;

use App\Helpers\Image\ImageUpload;
use Illuminate\Support\Facades\Auth;

class StorePictures{

    public static function with ($folderID, $albumID, $image){
        $user = Auth::user();

        return (new ImageUpload($image, $user, $folderID, $albumID, $profile=0))
         ->process();
    }
}