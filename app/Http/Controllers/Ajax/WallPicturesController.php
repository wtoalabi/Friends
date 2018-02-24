<?php

namespace App\Http\Controllers\Ajax;

use Illuminate\Http\Request;
use App\Helpers\Image\UserAlbum;
use App\Helpers\Image\ImageUpload;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class WallPicturesController extends Controller
{
    public function store (){
        //return true;
        //dd(request(['picture','imageUUID']));
        //dd(request()->all());
        $user = Auth::user();
        $image = (new ImageUpload(request('picture') ,$user, $folderID=2, $album = null, $profile=0))
         ->process();
        return response($image->id);
    }

    public function destroy ($id){
        ImageUpload::remove($id);
        return response(['message'=> 'Image Removed']);
    }
}
