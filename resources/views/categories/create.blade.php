@extends('../layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="panel panel-default">
             <div class="panel-heading">Créer une catégorie</div>
             <div class="panel-body">
                 <form class="form-horizontal" method="POST" action="{{ route('categories.store') }}">
                   @csrf

                   <table>
                       <td width="80%">
                           <div class="form-group">
                                <label for="name" class="col-md-4 control-label">Name</label>
                                <div class="col-md-12">
                                    <input id="name" type="text" class="form-control" name="name" required autofocus>
                                </div>
                            </div>
                        </td>
                        <td width="20%">
                            <div class="form-group">
                                <label for="private" class="col-md-3  control-label">Private</label>
                                <div class="col-md-3">
                                    <input id="private" type="checkbox" name="private" class="form-control">
                                </div>
                            </div>
                        </td>
                    </table>
                    <div class="form-group">
                        <div class="col-md-8 col-md-offset-4">
                            <button type="submit" class="btn btn-primary">
                                Ajouter
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
