<?php

namespace App\Http\Controllers\Ajax;

use Illuminate\Http\Request;
use App\Models\Statuses\Mood;
use App\Http\Controllers\Controller;

class Moods extends Controller
{
    public function index (){
        return Mood::orderBy('name', 'asc')
        ->get(['name','id']);
    }
}
