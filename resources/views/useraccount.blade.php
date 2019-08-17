@extends('layouts.app')

@section('content')
<h2>{{ Auth::user()->name }}, welcome to your dashboard</h1>
<div>
    <h3>Upload new photo</h3>
    <p>
        <a href="{{route('uploadphoto')}}" class="add">+</a>
    </p>
</div>
@endsection


@if(count($errors) > 0)
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        <ul>
            @foreach($errors->all() as $error)
            <li><strong>{{ $error }}</strong></li>
            @endforeach
        </ul>
    </div>
@endif