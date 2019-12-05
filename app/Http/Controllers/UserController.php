<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use Illuminate\Contracts\Auth\Guard;

use App\User;

class UserController extends Controller
{
    public function index()
    {
      //TODO
      //dd(Auth::user());
      $user = User::find(1);

      //dd($users);

      return view('user.index', [
      'user' => $user
      ]);
    }

    public function users()
    {
      //TODO
      //dd(Auth::user());

      $user = User::find(1);
      $users = $user->users()->get();

      //dd($users);

      return view('user.users', [
      'users' => $users
    ]);
    }

    public function edit()
    {
      //TODO
      //dd(Auth::user());
      $user = User::find(1);

      //dd($users);

      return view('user.edit', [
      'user' => $user
      ]);
    }
}
