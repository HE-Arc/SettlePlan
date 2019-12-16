@extends('../layouts.app')

@section('content')
<div class="container">



    <div class="row">
        <div class="col-sm-8 offset-sm-2">
            <h2>Update category {{$category->name}} </h>

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
            <form method="post" action="{{ route('category.update', $category->id) }}" enctype="multipart/form-data">
                @method('PATCH')
                @csrf
                <div class="form-group">
                    <label for="name">Name :</label>
                    <input type="text" class="form-control" name="name" value="{{ $category->name }}" />
                </div>

                <div class="form-group">
                    <label for="private">Private : </label>
                    <div class="col-md-3">
                        <input id="private" type="checkbox" name="private" class="form-control"
                            {{$category->private == 1 ? "checked" : ""}}>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">Update</button>
            </form>
            
        </div>
    </div>
</div>
@endsection
