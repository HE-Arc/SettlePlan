@extends('layouts.app')

@section('content')
<div id="welcome" class="flex-center position-ref full-height">
   @if(session()->get('success'))
        <div class="alert alert-success">
            {{ session()->get('success') }}
        </div>
    @endif
    <div class="content">
        <div class="title m-b-md">
            Welcome to SettlePlan
        </div>
    </div>
</div>
@endsection
