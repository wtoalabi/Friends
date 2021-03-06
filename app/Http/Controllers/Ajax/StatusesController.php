<?php

namespace App\Http\Controllers\Ajax;

use Illuminate\Http\Request;
use App\Models\Statuses\Status;
use App\Http\Controllers\Controller;
use App\Helpers\Statuses\GetStream;
use Illuminate\Support\Facades\Storage;

class StatusesController extends Controller
{
    public function home (){
        return GetStream::forHome();  
    }

    public function profile ($userID){
        return GetStream::forProfile($userID);
    }

    public function destroy ($id){
        $status = Status::findOrFail($id);
        foreach($status->status_images as $image){
            Storage::delete(["public/user/$image->full","public/user/$image->thumb"]);
        }
        $status->delete();
        return response(['message'=> "Status Destroyed!","delete_status"=>$status->id], 200);
    }
}
