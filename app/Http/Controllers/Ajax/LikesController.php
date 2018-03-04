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
            $totalLikes = $this->getTotalLikes($id);
            return response(['message'=>"Status Liked!", "status"=> 200, "total"=>$totalLikes]);
        }

        public function likeStatus ($userID,$statusID){
            $status = REDIS::HEXISTS("StatusLikes:Status$statusID", $userID);
            $totalLikes = $this->getTotalLikes($statusID);
            return response(['status'=>$status, 'total'=>$totalLikes]);
        }

        public function destroy ($like){
            Redis::HDEL("StatusLikes:Status$like->status_id", $like->user_id);
            $like->delete();
            $totalLikes = $this->getTotalLikes($like->status_id);
            return response(['message'=> "Unliked!", "status"=> 300, 'total'=>$totalLikes]);
        }
        public function getTotalLikes ($id){
            return Redis::HLEN("StatusLikes:Status$id");
        }
}
