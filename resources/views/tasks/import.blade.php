@extends('../layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="panel panel-default">
                <div class="panel-heading">Import a task</div>
                <div class="panel-body">
                    <form class="form-horizontal" method="POST" action="{{ route('tasks.store') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="name" class="col-md-4 control-label">Name</label>
                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" name="name" required autofocus value="{{ $task->name }}">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="description" class="col-md-4 control-label">Description</label>
                            <div class="col-md-6">
                                <textarea class="form-control rounded-0" id="description" name="description" rows="3">{{ $task->description }}</textarea>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="end_at" class="col-md-4 control-label">Due date : </label>
                            <div class="col-md-6">
                                <input id="end_at" type="date" class="form-control" name="end_at" value="{{ $task->end_at }}">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="category" class="col-md-4 control-label">Category</label>
                            <div class="col-md-6">
                                <select class="form-control" name="category">
                                    @foreach ($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        @if ($files->isNotEmpty())
                            @foreach ($files as $key => $file)
                            <div class="form-group">
                                <label>{{ $file->name }}</label>
                                <a href="{{ route('deleteFile', ['task_id' => $task->id, 'file_id' => $file->id]) }}" class="btn btn-danger">Delete</a>
                            </div>
                            @endforeach
                        @endif

                        <div class="form-group">
                            <div class="col-md-8 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Import
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
