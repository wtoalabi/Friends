<?php

namespace App\Models\Statuses;

use App\Models\Users\User;
use App\Models\Statuses\Status;
use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
    protected $fillable = ['user_id', 'status_id'];
    protected $hidden = [
        'created_at','updated_at',
    ];
    public function status (){
        return $this->belongsTo(Status::class);
   }
   public function user (){
        return $this->belongsTo(User::class);
   }
}
