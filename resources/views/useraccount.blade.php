@extends('layouts.app')

@section('pageTitle', 'User Account | LetzShare')

@section('content')

<div class="container">

    @if ($errors->any())
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <h2>{{ Auth::user()->user_id }}, welcome to your dashboard</h1>
    <div>
        <h3>Upload new photo</h3>
        <p>
            <a href="{{ route('uploadphoto') }}" class="add">+</a>
        </p>
    </div>
</div>

@endsection