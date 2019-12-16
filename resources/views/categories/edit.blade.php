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
            <form method="post" action="{{ route('categories.update', $category->id) }}" enctype="multipart/form-data">
                @method('PATCH')
                @csrf
                <table>
                    <td width="80%">
                        <div class="form-group">
                             <label for="name" class="col-md-4 control-label">Name</label>
                             <div class="col-md-12">
                                 <input id="name" type="text" class="form-control" name="name" value="{{ $category->name }}" required autofocus>
                             </div>
                         </div>
                     </td>
                     <td width="20%">
                         <div class="form-group">
                             <label for="private" class="col-md-3  control-label">Private</label>
                             <div class="col-md-3">
                                 <input id="private" type="checkbox" name="private" class="form-control"
                                    {{$category->private == 1 ? "checked" : ""}}>
                             </div>
                         </div>
                     </td>
                 </table>
                 <div class="form-group">
                     <div class="col-md-8 col-md-offset-4">
                         <button type="submit" class="btn btn-primary">
                             Update
                         </button>
                     </div>
                 </div>
            </form>
        </div>
    </div>
</div>
@endsection
