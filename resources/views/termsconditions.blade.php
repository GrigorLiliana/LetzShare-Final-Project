@extends('layouts.app')

@section('pageTitle', 'Terms & Conditions | LetzShare')

@section('content')

<div class="container">

    @if ( session('error') )
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            <span>{{ session('error') }}</span>
        </div>
    @endif

    <h1>Terms and conditions</h1>

</div> <!-- /container-->

@endsection
