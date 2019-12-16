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

            <table>
                <td>
                    <a href="{{ route('user.edit', $user->id) }}" class="btn btn-primary">Edit</a></td>
                </td>
                <td>

                    <form action="{{ route('user.destroy', $user->id) }}" method="post">
                      @csrf
                      @method('DELETE')
                      <button class="btn btn-danger" type="submit">Delete</button>
                    </form>@csrf
                </td>
        </div>
    </div>
</div>
@endsection
