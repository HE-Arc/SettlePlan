@extends('../layouts.app')

<script type='text/javascript'>
    var nbFileInput = 1;

    function addFields() {
        // Files <div> where dynamic content will be placed
        var files = document.getElementById("files");
        // Append a node with a random text
        //container.appendChild(document.createTextNode("Member " + (i+1)));

        var formGroup = document.createElement("div");
        formGroup.className = "form-group";

        // Create an <input> element, set its type and name attributes
        var input = document.createElement("input");
        input.type = "file";
        input.name = "file" + nbFileInput;
        input.className = "form-control-file";
        nbFileInput++;

        formGroup.appendChild(input);
        files.appendChild(formGroup);
    }
</script>

@section('content')
<div class="container">

    <div class="row">
        <div class="col-sm-8 offset-sm-2">
            <h2>Update tâche </h>

                @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                <br />
                @endif
                <form method="post" action="{{ route('tasks.update', $task->id) }}" enctype="multipart/form-data">
                    @method('PATCH')
                    @csrf
                    <div class="form-group">

                        <label for="name">Name :</label>
                        <input type="text" class="form-control" name="name" value="{{ $task->name }}" />
                    </div>

                    <div class="form-group">
                        <label for="description">Description : </label>
                        <textarea class="form-control rounded-0" id="description" name="description" rows="3"> {{ $task->description }}</textarea>
                    </div>

                    <div class="form-group">

                        <label for="date">Date de fin :</label>
                        @if (empty($task->end_at))
                        <input type="date" class="form-control" name="end_at" />
                        @else
                        <input type="date" class="form-control" name="end_at" value="{{date('Y-m-d', strtotime($task->end_at))}}" />
                        @endif

                    </div>

                    <div class="form-group">
                        <label for="category">Category</label>
                        <div>
                            <select class="form-control" name="category">
                                @foreach ($categories as $category)
                                @if ($category->id == $task->category->id)
                                <option value="{{ $category->id }}" selected="selected">{{ $category->name }}</option>
                                @else
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endif

                                @endforeach
                            </select>
                        </div>
                    </div>


                    @if ($files->isNotEmpty())
                    @foreach ($files as $key => $file)
                    <div class="form-group">
                        <label>{{ $file->getName() }}</label>
                        <a href="{{ route('deleteFile', ['task_id' => $task->id, 'file_id' => $file->id]) }}" class="btn btn-danger">Delete</a>
                    </div>
                    @endforeach
                    @endif

                    <div id="files"></div>

                    <div class="form-group">
                        <a href="#" id="filldetails" onclick="addFields()" class="btn btn-light">Add File</a>

                    </div>

                    <button type="submit" class="btn btn-primary">Update</button>
                </form>
        </div>
    </div>
</div>
@endsection
