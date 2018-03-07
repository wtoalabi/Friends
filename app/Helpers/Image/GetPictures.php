<?php

namespace App\Helpers\Image;

use App\Models\Images\Image;
use App\Models\Images\Album;

class GetPictures{

    public static function for ($userID, $folderID){
        $album = Album::where('folderID', $folderID)->first();
        
        if($folderID == 1){
            $whereCommand = static::getProfilePictures();
        }

        else if($folderID == 2){
            $whereCommand = static::getWallPictures();
        }
        
        else{
            $whereCommand = ['album_id', $album->id];
        }
        
        return Image::where([['user_id', $userID],$whereCommand])
                ->latest()->get();
    }

    public static function getProfilePictures (){
        return ['folderID', 1];
    }
    public static function getWallPictures (){
        return ['folderID', 2];
    }

}