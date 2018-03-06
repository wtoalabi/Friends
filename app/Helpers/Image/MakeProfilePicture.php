<?php

namespace App\Helpers\Image;

use App\Models\Images\Image;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class MakeProfilePicture{

    public static function Process ($id){
        DB::transaction(function () use ($id) {
            $userID = Auth::user()->id;
            static::findCurrentProfilePicture($userID);
            static::findPicture($id, $userID);
        });
        return;
    }

    public static function findCurrentProfilePicture ($userID){
        $current = Image::where([['user_id', $userID], ['profile', 1]])->first();
        if($current == null){
            return;
        }
        return static::removeProfile($current);
    }
    
    public static function removeProfile ($image){
        $image->profile = 0;
        return $image->save();
    }

    public static function findPicture ($id, $userID){
        $image = Image::where([['user_id', $userID],['id', $id]])->first();
        return static::makeProfile($image);
    }
    
    public static function makeProfile ($image){
        $image->folderID = 1;
        $image->profile = 1;
        return $image->save();
    }
}