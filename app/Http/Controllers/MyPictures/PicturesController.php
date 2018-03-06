<?php

namespace App\Http\Controllers\MyPictures;

use Illuminate\Http\Request;
use App\Models\Statuses\Status;
use App\Helpers\Image\GetPictures;
use App\Helpers\Image\StorePictures;
use App\Http\Controllers\Controller;
use App\Helpers\Statuses\CreateStatus;

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
        $status = Status::where('id', $status->id)->with([
            'mood','user'=>function($query){
                $query->with('images');
            }])
            ->withCount(['likes','comments','reshares'])
            ->first();
            return response(["message"=>"Status Posted", "status"=> $status], 200);
    }
}
