<?php

namespace App\Http\Controllers\Ajax;

use Illuminate\Http\Request;
use App\Helpers\Image\UserAlbum;
use App\Helpers\Image\ImageUpload;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class PictureUploadController extends Controller
{
    public function store (){
        //return true;
        //dd(request(['picture','imageUUID']));
        //dd(request()->all());
        $user = Auth::user();
        $album = UserAlbum::create("Wall Picture", $user->id);
        //dd($album);
        $image = (new ImageUpload(request('picture') ,$user, $album, $profile=0))
         ->process();
        return response($image->id);
    }

    public function destroy ($id){
        ImageUpload::remove($id);
        return response(['message'=> 'Image Removed']);
    }
}
