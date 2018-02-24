<?php
namespace App\Helpers\Statuses;

use App\Models\Images\Image;
use App\Models\Statuses\Status;
use Illuminate\Support\Facades\Auth;
use App\Models\Statuses\StatusImage;

class CreateStatus {

    protected $request;

    public static function with($request){
        $status = static::persist(collect($request));
        return $status;
    }
    
    public static function persist($request){
        if($request['mood'] == 0){
            $request['mood'] = 1;
        }
        $status = Status::create([
            'user_id'=> Auth::user()->id,
            'body'=> $request['body'],
            'mood_id'=> $request['mood'],
            'profile_id'=> $request['profileID'],
            ]);
        if($request['pictures']){
            static::savePicturesToStatus($request['pictures'], $status);
        }
        return $status;
    }
    public static function savePicturesToStatus ($pictures, $status){
        
        foreach($pictures as $index=>$ID){
            $image = Image::find($ID);
           $status->status_images()->save($image);
        }
        return;
    }
}