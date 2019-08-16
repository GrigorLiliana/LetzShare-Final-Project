@extends('layouts.app')

@section('content')
<h2>{{ Auth::user()->name }}, welcome to your dashboard</h1>
<div><h3>Upload new photo</h3>
<p><a href="{{route('uploadphoto')}}">+</a></p>
</div>
@endsection
