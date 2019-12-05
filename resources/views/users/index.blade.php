@extends('../layouts.app')

@section('content')


<div class="container">
  <div class="row">
    <div class="col-sm-12">
      <h2>User</h2>
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

    </div>
  </div>
</div>
@endsection
