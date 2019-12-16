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

      if($friend != null)
      {
        foreach ($user->users()->get() as $value) {
          if($value->id == $friend->id)
          {
            return redirect()->route('friends')->with('unsuccess','Demand did\'t send !');
          }
        }

        foreach ($friend->users()->get() as $value) {
          if($value->id == $user->id)
          {
            return redirect()->route('friends')->with('unsuccess','Demand did\'t send !');
          }
        }
      }
      else {
        return redirect()->route('friends')->with('unsuccess','Friend dosen\'t exist !');
      }

      $user->users()->attach($friend->id);

      $user->save();

      return redirect()->route('friends')->with('success','Friend updated successfully !');
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
      return view('user.index', [
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
      $user = User::find($id);
      return view('user.edit', [
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

        return redirect()->route('user.index')->with('success','User updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::find($id);
        $user->delete();

        return redirect('/')->with('success', 'Account deleted !');
    }


    public function friends()
    {
      $friendsDemand = null;
      $friendsWait = null;
      $friendsAccepted = null;

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


      return view('user.friends', [
      'friendsDemand' => $friendsDemand,
      'friendsWait' => $friendsWait,
      'friendsAccepted' => $friendsAccepted,
      ]);
    }

    public function deleteFriend($friend_id)
    {
        $user = User::find(Auth::user()->id);

        $result = UserUser::where(['user_id' => $user->id, 'user_id1' =>$friend_id])->delete();

        if ($result == 0)
        {
          $result = UserUser::where(['user_id1' => $user->id, 'user_id' =>$friend_id])->delete();

          if ($result == 0)
          {
            return redirect()->route('friends')->with('unsuccess','Friend didn\'t delete !');
          }
        }

        return redirect()->route('friends')->with('success','Friend deleted successfully !');
    }

    public function acceptDemand($friend_id)
    {
      $user = User::find(Auth::user()->id);

      $friendRel = UserUser::where(['user_id' => $friend_id, 'user_id1' => $user->id])->update(['status' => 1]);

      return redirect()->route('friends')->with('success','Demand accepted successfully !');
    }
}
