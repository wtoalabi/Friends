<?php

namespace App\Http\Controllers\Ajax;

use App\Models\Users\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class GetUserController extends Controller
{
    public function show ($id){
        return User::where('id',$id)
                ->withCount(['following','followers','statuses'])
                ->with(['images'=>function($query){
            $query->where('profile', 1);
        }])->first();
   }
}
