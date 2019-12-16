@extends('../layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-sm-12">
            <h2> Task of {{$categoryName}} from {{$userName}} : </h2>

            @if($newTask == 1)
                <div>
                    <a style="margin-bottom:5px;" href="{{ route('tasks.create')}}" class="btn btn-primary">New Task</a>
                </div>
            @endif

            <table class="table table-striped">
                <thead>
                    <tr>
                        <td>ID</td>
                        <td>Name</td>
                        <td>Description</td>
                        <td>Date de fin</td>
                        <td>Category</td>
                        <td>Fichier</td>

                        <td colspan=2>Actions</td>
                    </tr>
                </thead>
                <tbody>
                    @foreach($tasks as $task)
                    <tr>
                        <td>{{$task->id}}</td>
                        <td>{{$task->name}}</td>
                        <td style="word-break: break-word;">{{$task->description}}</td>
                        @if (empty($task->end_at))
                        <td></td>
                        @else
                        <td>{{date('d/m/y', strtotime($task->end_at))}}</td>
                        @endif
                        <td>{{$task->category->name}}</td>
    

                        @if (!isset($files[$task->id]))
                            <td></td>
                        @else
                            <td><a href="../storage/app/{{ $files[$task->id] }}">File</a></td>
                        @endif
                        @can('crud', $task->category)
                        <td>
                            <a href="{{ route('tasks.edit', $task->id)}}" class="btn btn-primary">Edit</a>
                        </td>
                        <td>
                            <form action="{{ route('tasks.destroy', $task->id)}}" method="post">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger" type="submit">Delete</button>
                            </form>
                        </td>
                        @endcan
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection