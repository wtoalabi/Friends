<?php

namespace App\Http\Controllers\Ajax;

use Illuminate\Http\Request;
use App\Models\Statuses\Status;
use App\Http\Controllers\Controller;

class GetCountsController extends Controller
{
    public function replies ($id){
        return Status::find($id)->comments()->count();
    }
    public function likes ($id){
         return Status::find($id)->likes()->count();
    }
    public function reshares ($id){
         return Status::find($id)->reshares()->count();
    }
}
