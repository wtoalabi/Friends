<?php

namespace App\Http\Controllers\Ajax;

use Illuminate\Http\Request;
use App\Models\Statuses\Like;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redis;

class LikesController extends Controller
{
    
    public function store ($id){
        //dd($id);
         $user = Auth::user();

         if($like = $user->likes->where('status_id', $id)->first()){
            return $this->destroy($like);
        }
        else{

            $like = Like::create([
                'user_id' => $user->id,
                'status_id' => $id,
                ]);
            }
         Redis::HSET("StatusLikes:Status$id", $user->id, 1);
         return response(['message'=>"Status Liked!", "status"=> 200]);
        }
    public function likeStatus ($userID,$statusID){
         return REDIS::HEXISTS("StatusLikes:Status$statusID", $userID);
    }
    public function destroy ($like){
        Redis::HDEL("StatusLikes:Status$like->status_id", $like->user_id);
        $like->delete();
        return response(['message'=> "Unliked!", "status"=> 300]);
    }
}
