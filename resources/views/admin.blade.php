@extends('layouts.app')

@section('content')

<div class="container">

    @if(\Session::has('error'))
        <div class="alert alert-danger">
            {{\Session::get('error')}}
        </div>
    @endif
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Dashboard
                </div>
                @if (auth()->user()->isAdmin == 1)
                    <div class="panel-body">
                        <a href="{{url('admin/routes')}}">Admin</a>
                    </div>
                @else
                    <div class="panel-heading">
                        Normal User
                    </div>
                @endif                    
            </div>
        </div>
    </div>
</div>

@endsection