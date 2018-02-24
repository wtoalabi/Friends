<?php

namespace App\Helpers\Observers;

use App\Models\Images\Image;
use Illuminate\Support\Facades\Storage;

class ImageObserver{
    public function deleting (Image $image){
        Storage::delete(["public/user/$image->full","public/user/$image->thumb"]);
    }
}