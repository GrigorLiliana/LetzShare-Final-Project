@extends('layouts.app')

@section('pageTitle', 'Chupelagaite Page')

@section('content')

<div class="container">
    <h1>Chupelagaite</h1>
<hr>

    <p>User ID: {{ $id = Auth::id() }}</p>
    <p>User: {{ $user = Auth::user() }}</p>
    <pre>
    {{-- {{ print_r($user) }} --}}
    </pre>



    @guest
        <p>I'm a <strong>@@guest</strong></p>
    @endguest


    @auth
        @if ( auth()->user()->isAdmin === 1 )
            <p>I'm authenticated <strong>@@auth and isAdmin</strong></p>
        @else
            <p>I'm authenticated <strong>@@auth</strong></p>
        @endif
    @endauth

    @if (Auth::check())
        <div class="alert alert-success" role="alert">
            {{ session('status') }}
            <div>
                <strong>return Auth::check() = </strong>
                <strong>{{ Auth::check() }}</strong>
            </div>
        </div>
    @endif

    @if ($user = Auth::user())
        <div class="alert alert-success" role="alert">
            {{ session('status') }}
            <div>
                <strong>return Auth::user() = </strong>
                <strong>{{ Auth::user() }}</strong>
            </div>
        </div>
    @endif

    <div class="errors">
        @if ( session('error') )
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <span>{{ session('error') }}</span>
            </div>
        @endif
    </div>

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

</div>

@endsection

