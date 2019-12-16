@extends('../layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-sm-12">
            <h2> Task of {{$category->name}} for {{$user->name}} : </h2>

            @if($newTask == 1)
                <div>
                    <a style="margin-bottom:5px;" href="{{ route('tasks.create')}}" class="btn btn-primary">New Task</a>
                </div>
            @endif

            <table class="table table-striped">
                <thead>
                    <tr>
                        <td>Name</td>
                        <td>Description</td>
                        <td>Due date</td>
                        <td>Files</td>

                        <td colspan=2>Actions</td>
                    </tr>
                </thead>
                <tbody>
                    @foreach($tasks as $task)
                    <tr>
                        <td>{{$task->name}}</td>
                        <td style="word-break: break-word;">{{$task->description}}</td>
                        @if (empty($task->end_at))
                        <td></td>
                        @else
                        <td>{{date('d/m/y', strtotime($task->end_at))}}</td>
                        @endif

                        <td>
                            @if (isset($files[$task->id]))
                                <a href="{{   route('download',  ['category_id' => $category->id, 'task_id' => $task->id,  'file_id' => $files[$task->id][0]]) }}">File</a>
                            @endif
                        </td>
                        
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
