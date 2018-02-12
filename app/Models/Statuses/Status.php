<?php

namespace App\Models\Statuses;

use App\Models\Users\User;
use App\Models\Statuses\Mood;
use Illuminate\Database\Eloquent\Model;

class Status extends Model
{
    protected $fillable = ['user_id', 'body', 'mood_id'];

    public function mood (){
         return $this->belongsTo(Mood::class);
    }
    public function user (){
         return $this->belongsTo(User::class);
    }
}
