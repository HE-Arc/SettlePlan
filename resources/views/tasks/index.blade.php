@extends('../layouts.app')

@section('content')
    <div class="container">
    <div class="row">

    <div class="col-sm-12">
        <div class="col-sm-12">
            <h2> Tasks : </h2>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <td>Category</td>
                        <td>Name</td>
                        <td>Description</td>
                        <td>Due date</td>
                        <td>Files</td>
                        <td colspan = 2>Actions</td>
                    </tr>
                </thead>
                <tbody>

                    @foreach($tasks as $task)
                        <tr>
                            <td>
                                <a href="{{ route('categories.show', $task->category->id)}}">{{$task->category->name}}</a>
                            </td>

                            <td>{{$task->name}}</td>

                            <td style="word-break: break-word;">{{$task->description}}</td>
                            <td>
                                @if (empty($task->end_at))
                                    {{date('d/m/y', strtotime($task->end_at))}}
                                @endif
                                </td>

                                <!-- A Modifier -->
                                <td>
                                    @if (isset($files[$task->id]))
                                            @foreach($files[$task->id] as $file)
                                                <p>
                                                    <a href="{{   route('download',  ['category_id' => $task->category->id, 'task_id' => $task->id,  'file_id' => $file->id ] ) }}">{{ $file->name}}</a>
                                                </p>
                                            @endforeach
                                    @endif
                                </td>

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
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            <div>
        </div>
    </div>
@endsection
