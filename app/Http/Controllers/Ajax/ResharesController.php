<?php

namespace App\Http\Controllers\Ajax;

use Illuminate\Http\Request;
use App\Models\Statuses\Status;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Helpers\Statuses\CreateStatus;

class ResharesController extends Controller
{
    public function store ($id){ 

        $status = Status::find($id);
        $user = Auth::user()->id;
        $status = Status::create([
            'user_id' => $user,
            'mood_id' => $status->mood_id,
            'original_id' => $status->id,
            'profile_id' => $user,
            'slug' => CreateStatus::generateSlug(),
            'body' => $status->body,
            'reshared_comment' => request('comment'),
            ]);
            return $status->with(['mood','user'=>function($query){
                $query->with('images');
            }])->first();

    }
    public function show ($id){
         return Status::find($id);
    }
}
