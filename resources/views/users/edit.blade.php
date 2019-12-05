@extends('layouts.app')

@section('content')
<form method="POST" action="{{ route('users.update', $user->id) }}">
  @csrf
  @method('PUT')
  <label for="name">Nom</label>
  <input id="name" type="text" name="name" value="{{ $user->name }}" required autocomplete="name" autofocus>
  <br/>
  <label for="email">E-Mail</label>
  <input id="email" type="email" name="email" value="{{ $user->email }}" required autocomplete="email">
  <br/>
  <input type="submit" value="Modifier"/>
  <input type="button" value="Annuler"/>
</form>
@endsection
