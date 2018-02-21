<?php

namespace App\Http\Controllers\User;

use App\Helpers\Users\Following;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Exception\NotFoundException;

class FollowingController extends Controller
{
    
    public function store (){
            //dd(request()->all());  
            $users = array_add(request()->all(), 'user', Auth::user());
            //dd($users);
            return (new Following($users))->make();

            //return response(['message'=>'Done'], 200);
    }
}
