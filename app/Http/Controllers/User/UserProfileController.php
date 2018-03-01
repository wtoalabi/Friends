<?php

namespace App\Http\Controllers\User;

use App\Models\Users\User;
use Illuminate\Http\Request;
use App\Models\Statuses\Status;
use App\Http\Controllers\Controller;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class UserProfileController extends Controller
{
    public function show ($username){
        $profileUser = User::where('username', $username)
                        ->first();
        //dd($profileUser);
        $profileStatuses = Status::where('profile_id', $profileUser->id)
        ->with(['mood','user'=>function($query){
            $query->with('images');
        }])        
        ->latest()
        ->paginate(5);
        //dd($profileStatuses);
            return view('users.profile.profile-page', compact('profileUser', 'profileStatuses'));
        
    }
}
