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
            $user = (new Following($users))->make();
            return redirect()->back();
    }
}
