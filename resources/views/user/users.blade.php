@extends('layouts.app')

@section('content')
  <h1>Friends</h1>
  <input type="text" placeholder="Nom..."/>
  <input type="button" value="Ajouter"/>
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
