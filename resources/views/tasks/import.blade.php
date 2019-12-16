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

        var divDisp = document.createElement("div");
        divDisp.className = "col-md-6";

        // Create an <input> element, set its type and name attributes
        var input = document.createElement("input");
        input.type = "file";
        input.name = "file" + nbFileInput;
        input.className = "form-control-file";
        nbFileInput++;

        divDisp.appendChild(input)
        formGroup.appendChild(divDisp);
        files.appendChild(formGroup);
    }
</script>

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
                                <input id="name" type="text" class="form-control" name="name" required autofocus value="{{ $import->name }}">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="description" class="col-md-4 control-label">Description</label>
                            <div class="col-md-6">
                                <textarea id="description" required name="description" class="form-control" rows="3">
                                    {{ $import->description }}
                                </textarea>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="end_at" class="col-md-4 control-label">Due date : </label>
                            <div class="col-md-6">
                                <input id="end_at" type="date" class="form-control" name="end_at" value="{{ $import->end_at }}">
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

                        <div class="form-group">
                            <div class="col-md-6">
                                <input type="file" name="files[]" class="form-control-file" multiple />
                            </div>
                        </div>

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
