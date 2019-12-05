@extends('layouts.app')

@section('content')
  <h1>User</h1>
  <table>
    <tr>
      <td>Nom : </td>
      <td>{{ $user->name }}</td>
    </tr>
    <tr>
      <td>Email : </td>
      <td>{{ $user->email }}</td>
    </tr>
    <tr>
      <td><a href="./users/friends">Voir amis</a></td>
    </tr>
    <tr>
      <td><a href="{{ route('users.edit', $user->id) }}">Modifier</a></td>
      <td><a href="{{ route('users.destroy', $user->id) }}">Supprimer</a></td>
    </tr>
  </table>
@endsection
