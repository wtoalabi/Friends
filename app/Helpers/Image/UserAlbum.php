<?php
namespace App\Helpers\Image;

use App\Models\Images\Album;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redis;

class UserAlbum{
    protected $albumName;
    protected $userID;
    protected $folderID;
    
    public static function create($name, $user){
        $album = new static; 
        $album->albumName = $name;
        $album->userID = $user->id;
        $album->folderID = $album->getFolderID();
        $newAlbum = $album->persistToDB();
         return $newAlbum;
    }
    public function getFolderID(){    
        $folderID = $this->generateIDFromRedisKeys();
        return Redis::HSET("UserAlbums:User$this->userID", $folderID, $this->albumName);
    }

    public function persistToDB(){
    
        $newAlbum =  Album::create([
            'name'=> $this->albumName, 
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