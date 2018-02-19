<?php

namespace App\Http\Controllers\Ajax;

use App\Models\Users\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class GetUser extends Controller
{
    public function show ($id){
        return User::where('id',$id)->withCount(['following','followers','statuses'])->with('profile_image')->first();
   }
}
