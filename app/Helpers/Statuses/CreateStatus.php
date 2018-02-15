<?php
namespace App\Helpers\Statuses;

use App\Models\Statuses\Status;
use Illuminate\Support\Facades\Auth;

class CreateStatus {

    protected $request;

    public static function with($request){
        $status = static::persist(collect($request));
        return $status;
    }
    
    public static function persist($request){
        //dd($request['mood']);
        return Status::create([
            'user_id'=> Auth::user()->id,
            'body'=> $request['body'],
            'mood_id'=> $request['mood'],
            'profile_id'=> $request['profileID'],
        ]);
        
    }
}