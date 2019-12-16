@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-sm-8 offset-sm-2">

          @if(session()->get('success'))
            <div class="alert alert-success">
              {{ session()->get('success') }}
            </div>
          @endif

          @if(session()->get('unsuccess'))
            <div class="alert alert-danger">
              {{ session()->get('unsuccess') }}
            </div>
          @endif

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
                <form action="{{ route('user.store') }}" method="POST">
                    @csrf
                    @method('POST')
                    <div class="form-group">
                        <input class="form-group" type="text" placeholder="Email..." name="email" />
                        <button type="submit" class="btn btn-primary">Add</button>
                    </div>
                </form>
                @isset($friendsDemand)
                <h3>Friends demands</h3>
                <table class="table table-striped">
                    @foreach($friendsDemand as $user)
                    <tr>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>

                        <td><a href="{{ route('deleteFriend', $user->id ) }}" class="btn btn-danger">Delete demand</a></td>
                    </tr>
                    @endforeach
                </table>
                @endisset
                @isset($friendsWait)
                <h3>Friends waiting</h3>
                <table class="table table-striped">
                    @foreach($friendsWait as $user)
                    <tr>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>

                        <td><a href="{{ route('acceptDemand', $user->id ) }}" class="btn btn-success">Accept</a></td>
                        <td><a href="{{ route('deleteFriend', $user->id ) }}" class="btn btn-danger">Delete demand</a></td>
                    </tr>
                    @endforeach
                </table>
                @endisset
                @isset($friendsAccepted)
                <h3>Friends</h3>
                <table class="table table-striped">
                    @foreach($friendsAccepted as $user)
                    <tr>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td><a href="{{ route('user.friends', $user->id ) }}" class="btn btn-primary">Show Profile</a></td>
                        <td><a href="{{ route('deleteFriend', $user->id ) }}" class="btn btn-danger">Delete friend</a></td>
                    </tr>
                    @endforeach
                </table>
                @endisset
        </div>
    </div>
</div>

@endsection
