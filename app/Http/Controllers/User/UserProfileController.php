<?php

namespace App\Http\Controllers\User;

use App\Models\Users\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserProfileController extends Controller
{
    public function show ($username){
        $user = User::where('username', $username)->first();
        return view('users.profile.show', compact('user'));
    }
}
