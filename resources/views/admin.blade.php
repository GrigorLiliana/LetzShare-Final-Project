@extends('layouts.app')

@section('pageTitle', 'Admin page | LetzShare')

@section('content')

<div class="container">

    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Dashboard
                </div>
                @if (auth()->user()->isAdmin === 1)
                    <div class="panel-body">
                        <a href="{{url('admin')}}">Admin</a>
                    </div>
                @else
                    {{ return redirect()->route('home')->with('error', 'Restricted area. You have not admin access') }}
                @endif                    
            </div>
        </div>
    </div>

</div> <!-- /container -->

@endsection
