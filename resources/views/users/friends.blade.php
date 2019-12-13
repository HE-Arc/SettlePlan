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
                <h3>Demandes d'amis</h3>
                <table class="table table-striped">
                    @foreach($friendsDemand as $user)
                    <tr>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td><a href="./delete_friend" class="btn btn-danger">Supprimer</a></td>
                    </tr>
                    @endforeach
                </table>
                <h3>Amis en attentes</h3>
                <table class="table table-striped">
                    @foreach($friendsWait as $user)
                    <tr>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td><a href="./accepted_demand" class="btn btn-success">Accepter</a></td>
                    </tr>
                    @endforeach
                </table>
                <h3>Amis</h3>
                <table class="table table-striped">
                    @foreach($friendsAccepted as $user)
                    <tr>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td><a href="./delete_friend" class="btn btn-danger">Supprimer l'ami</a></td>
                    </tr>
                    @endforeach
                </table>
        </div>
    </div>
</div>

@endsection
