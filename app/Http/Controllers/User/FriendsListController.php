<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class FriendsListController extends Controller
{
    public function index(){
         return view('users.friends.index');
    }
}
