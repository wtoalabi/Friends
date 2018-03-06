<?php

namespace App\Http\Controllers\MyPictures;

use Illuminate\Http\Request;
use App\Models\Images\Image;
use App\Models\Statuses\Status;
use App\Helpers\Image\GetPictures;
use App\Helpers\Image\StorePictures;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Helpers\Statuses\CreateStatus;
use Illuminate\Support\Facades\Storage;
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

    public function destroy ($id){
        $user = Auth::user()->id;
        $image = Image::where([['user_id', $user], ['id', $id]])->first();
        Storage::delete(["public/user/$image->full","public/user/$image->thumb"]);
        $image->delete();
    }
}
