<?php

namespace App\Models\Statuses;

use App\Models\Users\User;
use App\Models\Statuses\Mood;
use App\Models\Statuses\Like;
use App\Models\Statuses\Comment;
use App\Models\Statuses\Reshare;
use Illuminate\Database\Eloquent\Model;
use App\Helpers\Presenters\StatusPresenter as Presentable;

class Status extends Model
{
    use Presentable;
    protected $fillable = ['user_id', 'body', 'mood_id','profile_id'];

    public function mood (){
         return $this->belongsTo(Mood::class);
    }
    public function user (){
         return $this->belongsTo(User::class);
    }
    public function comments (){
         return $this->hasMany(Comment::class);
    }
    public function likes (){
        return $this->hasMany(Like::class);
   }
   public function reshares (){
    return $this->hasMany(Reshare::class);
}
}
