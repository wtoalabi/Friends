<?php

namespace App\Http\Controllers\User;

use App\Models\Users\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class FriendsListController extends Controller
{
    public function index($username){
        $user = User::where('username', $username)->first();
         return view('users.friends.index', compact('user'));
    }

    public function following (){
    }
    
    public function followers ($id){
        $user =  User::find($id);
        
        return $user->followers;
        }
}
