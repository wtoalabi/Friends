<?php

namespace App\Models\Statuses;

use App\Models\Statuses\Status;
use Illuminate\Database\Eloquent\Model;

class Reshare extends Model
{
    protected $fillable=['user_id', 'status_id', 'comment'];
    public function status (){
        return $this->belongsTo(Status::class);
   }
}
