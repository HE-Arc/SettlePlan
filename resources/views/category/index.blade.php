@extends('../layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-sm-12">
            <h2> Categories of {{$userName}} : </h2>

            @if($newCat == 1)
            <div>
                <a style="margin-bottom:5px;" href="{{ route('category.create')}}" class="btn btn-primary">New
                    category</a>
            </div>
            @endif

            <table class="table table-striped">
                <thead>
                    <tr>
                        <td>Name</td>
                        <td>prive</td>
                        <td colspan=2>Actions</td>
                    </tr>
                </thead>
                <tbody>
                    @foreach($categorys as $category)
                    <tr>
                        <td>
                            <a href="{{ route('category.show', $category->id)}}">{{$category->name}}</a>
                        </td>
                        <td>{{$category->private}}</td>

                        <td>
                            <a href="{{ route('category.edit',$category->id)}}" class="btn btn-primary">Edit</a>
                        </td>
                        <td>
                            <form action="{{ route('category.destroy', $category->id)}}" method="post">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger" type="submit">Delete</button>
                            </form>
                        </td>

                        @endforeach
                </tbody>
            </table>
            <div>
            </div>
        </div>
        @endsection
