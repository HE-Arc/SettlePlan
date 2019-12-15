@extends('../layouts.app')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-sm-12">
            <h2>User</h2>
            <table class="table table-striped">
                <tr>
                    <td class="label">Name : </td>
                    <td class="content">{{ $user->name }}</td>
                </tr>
                <tr>
                    <td class="label">Email : </td>
                    <td class="content">{{ $user->email }}</td>
                </tr>
            </table>
            <br/>
            <a href="{{ route('users.edit', $user->id) }}" class="btn btn-primary">Edit</a></td>
            <a href="{{ route('users.destroy', $user->id) }}" class="btn btn-danger">Delete</a></td>
        </div>
    </div>
</div>
@endsection
