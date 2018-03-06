<?php

namespace App\Helpers\Image;

use App\Models\Images\Album;
use App\Models\Images\Image;
use Illuminate\Support\Facades\Redis;

class GetAlbums{
    public static function for ($id){
        
        $albums = Album::where('user_id', $id)
                ->withCount('images')
                ->get();
        
        $userAlbums = $albums->toArray();
        $defaultAlbums = static::getDefaultAlbums($id);
        return $totalAlbums = array_merge($userAlbums, $defaultAlbums);
    }

    public static function  getDefaultAlbums($id){
         
        $profileCount = static::getCountForDefaultFolders($id,1);
        $wallCount = static::getCountForDefaultFolders($id,2);
        $defaultAlbums = [
                            [
                                "folderID" => 1,
                                "name" => "Profile Pictures",
                                "images_count"=>$profileCount,
                                "created_at" =>'2018-03-04'
                            ],
                            [
                                "folderID" => 2,
                                "name" => "Wall Pictures",
                                "images_count" => $wallCount,
                                "created_at" =>'2018-03-05'
                                ]
                        ];
        
         return $defaultAlbums;
    }
    
    public static function getCountForDefaultFolders ($id, $folderID){
         return Image::where([['user_id', $id],['folderID', $folderID]])->count();
    }
}