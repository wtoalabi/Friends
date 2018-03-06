<?php

namespace App\Helpers\Image;

use App\Models\Images\Image;

class GetPictures{

    public static function for ($userID, $folderID){
        return Image::where([['user_id', $userID], ['folderID', $folderID]])
                ->latest()->get();
    }

}