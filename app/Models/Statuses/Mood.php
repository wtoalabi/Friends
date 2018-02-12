<?php

namespace App\Models\Statuses;

use App\Models\Statuses\Status;
use Illuminate\Database\Eloquent\Model;

class Mood extends Model
{
    protected $fillable = ['name', 'icon'];
    protected $hidden = ['created_at', 'updated_at'];
    public function statuses (){
        return $this->hasMany(Status::class);
   }
}
