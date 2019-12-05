@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-sm-8 offset-sm-2">
            <h2>Friends</h>

                @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                <br />
                @endif
                <form action="{{ route('users.store') }}" method="POST">
                    @csrf
                    @method('POST')
                    <div class="form-group">
                        <input class="form-group" type="text" placeholder="Email..." name="email" />
                        <button type="submit" class="btn btn-primary">Ajouter</button>
                    </div>
                </form>
        </div>
    </div>
</div>
<table border="1">
    @foreach($users as $user)
    <tr>
        <td>{{ $user->name }}</td>
        <td>{{ $user->email }}</td>
        <td><input type="button" value="Supprimer" /></td>
    </tr>
    @endforeach
</table>
@endsection
