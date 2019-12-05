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
      <td><a href="./users">Voir amis</a></td>
    </tr>
    <tr>
      <td><a href="./user/{{ $user->id }}/edit">Modifier</a></td>
      <td><a href="./user/{{ $user->id }}/delete">Supprimer</a></td>
    </tr>
  </table>
@endsection
