<?php
namespace App\Helpers\Image;

use Illuminate\Support\Facades\Redis;

class FolderIdsOnRedis{

    public static function CreateDefaultFolders ($userID){
        Redis::HSET("UserFolders:User$userID", 1, "Profile Pictures");
        Redis::HSET("UserFolders:User$userID", 2, "Wall Pictures");
    }

    public static function CreateFolderForUserGeneratedAlbums (){
         ;
    }
}