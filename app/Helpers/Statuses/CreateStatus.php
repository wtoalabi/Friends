<?php
namespace App\Helpers\Statuses;

use Carbon\Carbon;
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
        $slug = static::generateSlug($request['body']);
        $status = Status::create([
            'user_id'=> Auth::user()->id,
            'body'=> $request['body'],
            'slug'=> $slug,
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

    public static function generateSlug ($body){
        $name = Auth::user()->username;
        
        $slug = str_slug(str_limit($body, 20));
        return sprintf("%s/%s/%s", $name, 'status', str_random(30).time());
    }
}