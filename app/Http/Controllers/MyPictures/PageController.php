<?php

namespace App\Http\Controllers\MyPictures;

use App\Models\Users\User;
use Illuminate\Http\Request;
use App\Helpers\Image\GetAlbums;
use App\Helpers\Image\GetPictures;
use App\Http\Controllers\Controller;


class PageController extends Controller
{
    public function index($username){
        $user = User::where('username', $username)->first();
         return view('users.pictures.index',compact('user'));
    }

    public function folders ($userID){
        return GetAlbums::for($userID);
    }
    public function pictures ($userID, $folderID){
        return GetPictures::for($userID, $folderID);
    }
}
