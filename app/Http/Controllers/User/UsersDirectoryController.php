<?php

namespace App\Http\Controllers\User;

use App\Models\Users\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UsersDirectoryController extends Controller
{
    public function index (){

        $users = User::with('statuses')->latest()->paginate(1);
        return view('users.users_directory.index',compact('users'));
    }
}
