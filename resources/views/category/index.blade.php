@extends('../layouts.app')

@section('content')
<div class="container">
<div class="row">
<div class="col-sm-12">
  <h2 > Categories of {{$userName}} : </h2>

  @if($newCat == 1)
      <div>
        <a style="margin-bottom:5px;" href="{{ route('category.create')}}" class="btn btn-primary">New category</a>
      </div>
  @endif

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
