<?php

namespace App\Http\Controllers\User;

use App\Helpers\Users\Following;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Exception\NotFoundException;

class FollowingController extends Controller
{
    
    public function store (){
        $users = array_add(request()->all(), 'user', Auth::user());
            return (new Following($users))->make();
    }
}
