<?php

namespace App\Http\Controllers\Statuses;

use Alert;
use App\Models\Users\User;
use Illuminate\Http\Request;
use App\Models\Statuses\Status;
use App\Http\Controllers\Controller;
use App\Http\Requests\ValidateStatus;
use App\Helpers\Statuses\CreateStatus;
use App\Events\Statuses\StatusCreated;

class StatusController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

       /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ValidateStatus $valid)
    {
        //dd(collect($valid->request));
        //dd(request()->all());
        $status = CreateStatus::with($valid->request);
        event(new StatusCreated($status));
        $status = Status::where('id', $status->id)->with([
                    'mood','user'=>function($query){
                        $query->with('images');
                    }])->first();
                    //dd($status);
        return response(["message"=>"Status Posted", "status"=> $status], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($username, $slug)
    {   
        $slug = $username . "/status/". $slug;
        //dd($slug);
        //return Status::where('slug', $slug)
        $status = Status::where('slug', $slug)
                ->with(['status_images','user' => function($query){
                    $query->with('images');
                },'mood','likes','comments','reshares'])
                ->withCount('likes','comments', 'reshares')
                ->first();
        return view('users.statuses.status-details', compact('status'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $status = Status::find($id);
        $status->delete();

        return redirect('home');

    }
}
