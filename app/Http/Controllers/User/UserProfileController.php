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
        $user = User::where('username', $username)->first();
        if($user){
            $statuses = Status::where('profile_id', $user->id)
                                ->with('mood','user')
                                ->latest()
                                ->paginate(10);
            //$statuses = $user->statuses()->with('mood', 'user')->latest()->paginate(10);
            return view('users.profile.show', compact('user', 'statuses'));
        }
        throw new NotFoundHttpException;
    }
}
