<?php

namespace App\Http\Controllers\Ajax;

use Illuminate\Http\Request;
use App\Models\Statuses\Reshare;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class ResharesController extends Controller
{
    public function store ($id){ 
        $user = Auth::user()->id;
        $reshared = Reshare::create([
            'user_id' => $user,
            'status_id' => $id,
            'comment' => request('comment'),
        ]);

        return $reshared;

    }
}
