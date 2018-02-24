<?php

namespace App\Models\Statuses;

use App\Models\Images\Image;
use App\Models\Statuses\Status;
use Illuminate\Database\Eloquent\Model;

class StatusImage extends Model
{
    protected $fillable=['image_id','status_id'];

    public function status(){
        return $this->belongsTo(Status::class);
    }
}
