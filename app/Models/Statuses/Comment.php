<?php

namespace App\Models\Statuses;

use App\Models\Users\User;
use App\Models\Statuses\Status;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $casts=[
        'id'=> 'int',
        'parent_id' =>'array'
    ];
    protected $fillable =  ['user_id', 'status_id', 'body','parent_id'];

    public function status (){
         return $this->belongsTo(Status::class);
    }
    public function user (){
         return $this->belongsTo(User::class);
    }
}
