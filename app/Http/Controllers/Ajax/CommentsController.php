<?php

namespace App\Http\Controllers\Ajax;

use Illuminate\Http\Request;
use App\Models\Statuses\Status;
use App\Models\Statuses\Comment;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class CommentsController extends Controller
{
    public function store (Status $status){
        //dd(request()->all());
        $comment = request() ->validate([
            'body' => 'required'
        ]);

        $comment = Comment::create([
            'user_id'=> Auth::user()->id,
            'status_id'=> $status->id,
            'body'=> request('body')
        ]);

        return response(['message'=>"Comment Posted!", 'comment'=>$comment], 200);
        //dd($comment);
    }
}
