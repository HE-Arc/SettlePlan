@extends('../layouts.app')

@section('content')
<div class="container">
<div class="row">
<div class="col-sm-12">
    <h2 > Categories of {{$user->name}} : </h2>

    <table class="table table-striped">
        <thead>
            <tr>
                <td>Name</td>
            </tr>
        </thead>
        <tbody>
            @foreach($categorys as $category)
            <tr>
                <td>
                    <a href="{{ route('category.showUserCategory',
                        ['user_id' => $user->id, 'category_id' => $category->id])}}">
                        {{$category->name}}
                    </a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
