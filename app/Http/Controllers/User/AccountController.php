<?php

namespace App\Http\Controllers\User;


use Illuminate\Http\Request;
use App\Helpers\Users\Account;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\ValidatesUser;
use App\Events\Registration\UserRegistered;

class AccountController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest')->only('store');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function store(ValidatesUser $validated)
    {
        $user = Account::persist(request());
        //dd($user);

        event(new UserRegistered($user));

        auth()->login($user);

        return redirect('home');
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
