<?php

namespace App\Http\Controllers\Ajax;

use App\Models\Users\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class GetUserController extends Controller
{
    public function index (){
        return $users = User::with(['images'=>function($query){
            $query->where('profile', 1);
        }])
         ->orderBy('last_name', 'asc')
         ->paginate(12);
    }
    
    public function show ($id){
        return User::where('id',$id)
                ->withCount(['following','followers','statuses','images'])
                ->with(['images'=>function($query){
            $query->where('profile', 1);
        }])->first();
   }
}
