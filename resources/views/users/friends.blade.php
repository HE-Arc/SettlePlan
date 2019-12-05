@extends('layouts.app')

@section('content')
  <h1>Friends</h1>
  <form action="{{ route('users.store') }}" method="POST">
    @csrf
    @method('GET')
    <input type="text" placeholder="Email..." name="email"/>
    <input type="submit" value="Ajouter"/>
  </form>
  <table border="1">
    @foreach($users as $user)
        <tr>
          <td>{{ $user->name }}</td>
          <td>{{ $user->email }}</td>
          <td><input type="button" value="Supprimer"/></td>
        </tr>
    @endforeach
  </table>
@endsection
