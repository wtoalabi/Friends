<?php
namespace App\Helpers\Image;

use Illuminate\Support\Facades\Redis;

class FolderIdsOnRedis{

    public static function CreateDefaultFolders ($userID){
        Redis::HSET("UserFolders:User$userID", 1, "Profile Pictures");
        Redis::HSET("UserFolders:User$userID", 2, "Wall Pictures");
    }

    public static function CreateFolderID ($id, $name){
        $folderID = str_random(5);
        Redis::HSET("UserFolders:User$id",$folderID, $name);
        return $folderID;
    }
}