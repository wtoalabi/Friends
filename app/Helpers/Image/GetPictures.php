<?php

namespace App\Helpers\Image;

use App\Models\Images\Image;
use App\Models\Images\Album;

class GetPictures{

    public static function for ($userID, $folderID){
        $album = Album::where('folderID', $folderID)->first();
        
        if($folderID == 1){
            $whereCommand = ['folderID', 1];
        }
        else{
            $whereCommand = ['album_id', $album->id];
        }
            return Image::where([['user_id', $userID],$whereCommand])
            ->latest()->get();
    }

}