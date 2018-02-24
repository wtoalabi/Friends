<?php

namespace App\Http\Controllers\Ajax;

use App\Models\Users\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class UsersToFollowController extends Controller
{
    public function index(){
        $usersToFollow = Auth::user()->following()->pluck('follow_id');
        $usersToFollow[] = Auth::user()->id;
        return User::whereNotIn('id', $usersToFollow)
                            ->with(
                                ['images'=>function($query){
                                    $query->where('folderID', 1);
                                }]
                                )
                            ->inRandomOrder()
                            ->take(6)->get();
         ;
    }
}
