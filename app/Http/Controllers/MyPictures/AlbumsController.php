<?php

namespace App\Http\Controllers\MyPictures;

use Illuminate\Http\Request;
use App\Helpers\Image\GetAlbums;
use App\Helpers\Image\CreateAlbum;
use App\Http\Controllers\Controller;

class AlbumsController extends Controller
{
    public function index ($userID){
        return GetAlbums::for($userID);
    }

    public function store (){
         $validated = request()->validate([
             'albumName'=> 'required',
             'albumDescription' => 'nullable'
         ]);
         return CreateAlbum::with($validated);
    }
}
