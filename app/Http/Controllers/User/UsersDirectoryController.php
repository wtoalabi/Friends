<?php

namespace App\Http\Controllers\User;

use App\Models\Users\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UsersDirectoryController extends Controller
{
    public function index (){

        $users = User::with(['statuses','images','following','followers'])
                        ->orderBy('last_name', 'asc')
                        ->paginate(12);
        return view('users.users_directory.index',compact('users'));
    }
}
