<?php

namespace App\Http\Controllers\User;

use Auth;
use App\Models\Users\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SettingsController extends Controller
{
    public function show ($username){
        return view('users.settings.index');
    }
    
    public function update ($username){
        //dd(request()->all());
        request()->validate([
            'email' => 'email|unique:users,email,'.Auth::id()
        ]);
        $request = request()->all();
        $user = User::where('username', $username)->first();
        $user->fill($request);
        $user->save();
        return response(['status'=>'Done', 'user'=>$user]);
        
    }
}
