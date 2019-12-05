<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use Illuminate\Contracts\Auth\Guard;

use App\User;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      //TODO
      //dd(Auth::user());
      return $this->show(Auth::user()->id);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      $user = User::find(Auth::user()->id);
      $email = $request->input('email');
      $friend = User::all()->where('email', $email)->first();
      $user->users()->attach($friend->id);

      //dd($user);

      $user->save();

      return $this->friends();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
      $user = User::find($id);
      return view('users.index', [
      'user' => $user
      ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
      //TODO
      //dd(Auth::user());
      $user = User::find($id);

      //dd($users);

      return view('users.edit', [
      'user' => $user
      ]);
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
      $request->validate([
            'name' => 'required',
            'email' => 'required',
        ]);

        $user = User::find($id);
        $user->update($request->all());

        return redirect()->route('users.index')->with('success','User updated successfully');
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


    public function friends()
    {
      //TODO
      $user = User::find(Auth::user()->id);

      $friendsDemand = UserUser::where('user_id1', $user->id)->where('status', 0)->value('user_id');

      $friendsWait = UserUser::select()->where('user_id', $user->id)->where('status', 0)->value('user_id');

      $friendsAccepted = UserUser::select()->where('user_id', $user->id)->where('status', 1)->value('user_id');

      $users = $user->users()->get();

      //dd($users);

      return view('users.friends', [
      'users' => $users
      ]);
    }
}
