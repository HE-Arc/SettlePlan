@extends('../layouts.app')

@section('content')
<div class="container">
<div class="row">
<div class="col-sm-12">
  <h2> Catégories : </h2>

  <form action="{{ route('category.create')}}" method="post">
    @csrf
    @method('GET')
    <button class="btn btn-large btn-primary" type="submit">New Category</button>
  </form>

  <table class="table table-striped">
    <thead>
        <tr>
          <td>Name</td>
          <td>prive</td>
          <td colspan = 2>Actions</td>
        </tr>
    </thead>
    <tbody>
        @foreach($categorys as $category)
        <tr>
            <td>{{$category->name}}</td>
            <td>{{$category->private}}</td>

        @endforeach
    </tbody>
  </table>
<div>
</div>
</div>
@endsection
