@extends('../layouts.app')

@section('content')


<div class="container">
  <div class="row">
    <div class="col-sm-12">
      <h2>User</h2>
      <table>
        <tr>
          <td>Name : </td>
          <td>{{ $user->name }}</td>
        </tr>
        <tr>
          <td>Email : </td>
          <td>{{ $user->email }}</td>
        </tr>
        <tr>
          <td><a href="{{ route('users.edit', $user->id) }}"  class="btn btn-primary">Edit</a></td>
          <td><a href="{{ route('users.destroy', $user->id) }}" class="btn btn-danger">Delete</a></td>
        </tr>
      </table>

    </div>
  </div>
</div>
@endsection
