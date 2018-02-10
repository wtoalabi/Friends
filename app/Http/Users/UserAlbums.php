<?php
namespace App\Http\Users;

use App\User\Album;

class UserAlbums{

    public static function createNew($name, $userID){
        return Album::create(['name'=> $name, 'user_id'=> $userID]);
    }

}