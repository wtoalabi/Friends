<?php

namespace App\Helpers\Image;

use App\Models\Images\Album;
use Illuminate\Support\Facades\Auth;
use App\Helpers\Image\FolderIdsOnRedis;

class CreateAlbum{

    public static function with ($validated){
        $userID = Auth::user()->id;
        $folderID = FolderIdsOnRedis::CreateFolderID($userID,$validated['albumName']);

        $album = Album::create([
            'user_id' => $userID,
            'name'=> $validated['albumName'],
            'description' => $validated['albumDescription'],
            'folderID' => $folderID
        ]);

        return $album;
        
    }

}