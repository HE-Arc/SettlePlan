@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-sm-8 offset-sm-2">
            @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            </br>
            @endif
            <form method="POST" action="{{ route('users.update', $user->id) }}">
                @csrf
                @method('PATH')

                <div class="form-group">
                    <label for="name">Name</label>
                    <input id="name" class="form-control" type="text" name="name" value="{{ $user->name }}" required autocomplete="name" autofocus />
                </div>

                <div class="form-group">
                    <label for="email">E-Mail</label>
                    <input id="email" class="form-control" type="email" name="email" value="{{ $user->email }}" required autocomplete="email" />
                </div>
                <button class="btn btn-primary" type="submit">Update</button>
                <a href="{{ route('users.index') }}" class="btn btn-danger">Cancel</a>
            </form>
        </div>
    </div>
</div>
@endsection
