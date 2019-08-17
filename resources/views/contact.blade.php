@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col col-sm-12 col-md-8">
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
            @if($message = Session::get('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
                <strong>{{ $message }}</strong>
            </div>
            @endif
            <div class="card">
                <div class="card-header"><h3>Get in touch</h3></div>
                <div class="card-body">
                    <form class="formbox" method="POST" action="{{ url('contact/sendemail') }}">
                        @csrf
                        <div class="form-group">
                            <label for="fullname">Full name</label>
                            <input type="text" class="form-control" id="fullname" name="fullname" placeholder="Enter full name" required>
                        </div>
                        <div class="form-group">
                            <label for="email">E-Mail address</label>
                            <input type="email" class="form-control" id="email" name="email" placeholder="Enter e-mail" required>
                        </div>
                        <div class="form-group">
                            <label for="message">Your message</label>
                            <textarea class="form-control" id="message" name="message" rows="3" required></textarea>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary btn-block">Send message</button>
                        </div>
                    </form>
                </div>
                </div>
        </div>
    </div>
</div>
@endsection

