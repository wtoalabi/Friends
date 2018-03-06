<?php

namespace App\Http\Controllers\MyPictures;

use App\Models\Users\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;


class PageController extends Controller
{
    public function index($username){
        $user = User::where('username', $username)->first();
         return view('users.pictures.index',compact('user'));
    }
}
