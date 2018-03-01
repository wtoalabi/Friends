<?php

namespace App\Http\Controllers\Ajax;

use Illuminate\Http\Request;
use App\Models\Statuses\Status;
use App\Models\Statuses\Comment;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class CommentsController extends Controller
{
    public function index ($id){
         return Comment::where('status_id', $id)
            ->with(['user'=>function($query){
                $query->with(['images'=>function($query){
                    $query->where('profile', 1)->first();
                }]);
            }])
            ->latest()
            ->paginate(2);
    }
    public function store (Status $status){
        $comment = request() ->validate([
            'body' => 'required'
        ]);

        $comment = Comment::create([
            'user_id'=> Auth::user()->id,
            'status_id'=> $status->id,
            'body'=> request('body'),
            'parent_id'=> request('parentID')
        ]);
        
        return $comment->where('id', $comment->id)
            ->with(['user'=>function($query){
                $query->with(['images'=>function($query){
                    $query->where('profile', 1)->first();
            }]);
        }])
        ->first();
    }

    public function destroy ($statusID, $commentID){
        $userid = Auth::user()->id;
         $comment = Comment::where([['id', $commentID],['status_id', $statusID],['user_id', $userid]])
                            ->first();
         $comment->delete();
         return response("Comment Deleted", 200);
    }
}
