@extends('layouts.app')

@section('content')
<div class="container box">
    <div class="col-md-6 offset-3">
        {{-- <div class="google-maps">
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d1295.5246824390836!2d5.948985344473696!3d49.50246177631499!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x479535034c0a600b%3A0xe8b8bed0e26f33a!2sTechnoport+S.a.!5e0!3m2!1sfr!2slu!4v1565942515575!5m2!1sfr!2slu" width="600" height="450" frameborder="0" style="border:0" allowfullscreen></iframe>
        </div> --}}
        @if(count($errors) > 0)
            <div class="alert alert-danger">
                <button type="button" class="close" data-dissmiss="alert">X</button>
                <ul>
                    @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        @if($message = Session::get('success'))
        <div class="alert alert-success alert-block">
                <button type="button" class="close" data-dissmiss="alert">X</button>
                <strong>{{ $message }}</strong>
            </div>
        @endif
        <form class="formbox" method="POST" action="{{ url('contact/sendemail') }}">
            @csrf

                <div class="form-group">
                    <label for="fullname">Full name</label>
                    <input type="text" class="form-control" id="fullname" name="fullname" placeholder="Enter full name">
                </div>
                <div class="form-group">
                    <label for="email">Email address</label>
                    <input type="email" class="form-control" id="email" name="email" placeholder="Enter email">
                </div>
                <div class="form-group">
                    <label for="message">Your message</label>
                    <textarea class="form-control" id="message" name="message" rows="3"></textarea>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary btn-block">Send message</button>
                </div>

        </form>
    </div>
</div>
@endsection

