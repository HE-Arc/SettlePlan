<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use Illuminate\Contracts\Auth\Guard;

use App\User;
use App\UserUser;

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

      $friendsDemand = null;
      $friendsWait = null;

      $user = User::find(Auth::user()->id);

      $friendsDemandID = UserUser::where(['user_id' => $user->id, 'status' => 0])->get();

      foreach ($friendsDemandID as $value) {
        $friendsDemand[] = User::find($value->getUserIdDemand());
      }

      $friendsWaitID = UserUser::where(['user_id1' => $user->id, 'status' => 0])->get();

      foreach ($friendsWaitID as $value) {
        $friendsWait[] = User::find($value->getUserIdWait());
      }

      $friendsAcceptedID1 = UserUser::where(['user_id' => $user->id, 'status' => 1])->get();
      $friendsAcceptedID2 = UserUser::where(['user_id1' => $user->id, 'status' => 1])->get();

      foreach ($friendsAcceptedID1 as $value) {
        $friendsAccepted[] = User::find($value->getUserIdDemand());
      }

      foreach ($friendsAcceptedID2 as $value) {
        $friendsAccepted[] = User::find($value->getUserIdWait());
      }


      return view('users.friends', [
      'friendsDemand' => $friendsDemand,
      'friendsWait' => $friendsWait,
      'friendsAccepted' => $friendsAccepted,
      ]);
    }

    public function deleteFriend($request)
    {
      /*
        $user = User::find(Auth::user()->id);

        dd($request);


        $result = UserUser::where(['user_id' => $user->id, 'user_id1' =>$idFriend])->delete();

        dd($result);

        //Test Result

        $result = UserUser::where(['user_id1' => $user->id, 'user_id' =>$idFriend])->delete();
        */
    }

    public function acceptedDemand()
    {

    }
}
