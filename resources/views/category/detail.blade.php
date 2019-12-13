@extends('../layouts.app')

@section('content')
<div class="container">
<div class="row">
<div class="col-sm-12">
  <h2 > Task of {{$categoryName}} from {{$userName}} : </h2>

  @if($newTask == 1)
      <div>
        <a style="margin-bottom:5px;" href="{{ route('task.create')}}" class="btn btn-primary">New Task</a>
      </div>
  @endif

  <table class="table table-striped">
    <thead>
        <tr>
          <td>Name</td>
          <td>description</td>
          <td colspan = 2>Actions</td>
        </tr>
    </thead>
    <tbody>
        @foreach($tasks as $task)
        <tr>
            <td>
                <a href="{{ route('tasks.index')}}">{{$task->name}}</a>
            </td>
            <td>{{$task->description}}</td>

        @endforeach
    </tbody>
  </table>
<div>
</div>
</div>
@endsection
