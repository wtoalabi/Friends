<?php
namespace App\Helpers\Image;

use App\Models\Images\Album;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redis;

class UserAlbum{
    protected $name;
    protected $userID;
    protected $folderID;
    
    public static function create($name, $user){
        $album = new static; 
        if($albumFound = $album->checkAlbumExistence($name, $user)){
            return $albumFound;
        }
        else{
            $album->name = $name;
            $album->userID = $user;
            $album->folderID = $album->getFolderID();
            $album = $album->persistToDB();
            return $album;
        }
    }
    public function checkAlbumExistence ($name, $user){
         return Album::where([["name", "=", "Wall Picture"],["user_id", "=" , $user]])->first();
    }
    public function getFolderID(){    
        $folderID = $this->generateIDFromRedisKeys();
        return Redis::HSET("UserAlbums:User$this->userID", $folderID, $this->name);
    }

    public function persistToDB(){
    
        $newAlbum =  Album::create([
            'name'=> $this->name, 
            'folderID'=> $this->folderID, 
            'user_id'=> $this->userID
            ]);
            return $newAlbum;
    }
    public function generateIDFromRedisKeys(){        
        $totalAlbumsInRedis = Redis::HLEN("UserAlbums:User$this->userID");
        return $IncreaseFolderIDByOne = $totalAlbumsInRedis +1;
    }
    
}