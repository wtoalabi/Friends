<?php

namespace App\Http\Controllers\MyPictures;

use Illuminate\Http\Request;
use App\Models\Statuses\Status;
use App\Helpers\Image\GetPictures;
use App\Helpers\Image\StorePictures;
use App\Http\Controllers\Controller;
use App\Helpers\Statuses\CreateStatus;
use App\Helpers\Image\MakeProfilePicture;

class PicturesController extends Controller
{
    public function index ($userID, $folderID){
        return GetPictures::for($userID, $folderID);
    }

    public function store ($folderID, $albumID){
        $image = StorePictures::with($folderID, $albumID, request('picture'));
        return $image->id;
    }

    public function storePicturesStatus (){
        $status = CreateStatus::with(request()->all());
        return response(["message"=>"Status Posted", "status"=> $status], 200);
    }
    public function update ($id){
        MakeProfilePicture::Process($id);
        return response(['status'=>'Picture Updated!']);
    }
}
