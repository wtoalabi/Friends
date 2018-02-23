<?php

namespace App\Http\Controllers\Statuses;

use Alert;
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
        dd(collect($valid->request));
        //dd(request()->all());
        $status = CreateStatus::with($valid->request);
        //dd($status);
        event(new StatusCreated($status));
        $status = Status::where('id', $status->id)->with([
                    'mood','user'=>function($query){
                        $query->with('profile_image');
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
    public function show($id)
    {
        //
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
        //
    }
}
