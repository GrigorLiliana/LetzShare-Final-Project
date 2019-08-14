@extends('layouts.app')

@section('content')
<div class="container">
    <form class="formbox">
        <div class="col-md-6 offset-3">
            <div class="form-group">
                <label for="fullname">Full name</label>
                <input type="text" class="form-control" id="fullname" name="fullname" placeholder="Enter full name" required>
            </div>
            <div class="form-group">
                <label for="email">Email address</label>
                <input type="email" class="form-control" id="email" name="email" placeholder="Enter email" required>
            </div>
            {{-- <div class="form-group">
                <label for="subject">Subject</label>
                <input type="text" class="form-control" id="subject" name="subject" placeholder="Password" required>
            </div> --}}
            <div class="form-group">
                <label for="message">Your message</label>
                <textarea class="form-control" id="message" name="message" rows="3"></textarea>
            </div>
            <div class="form-check">
                <input type="checkbox" class="form-check-input" id="sendEmail" name="sendEmail">
                <label class="form-check-label" for="sendEmail">send me a copy per e-mail</label>
            </div><br>
            <button type="submit" class="btn btn-primary btn-block">Submit</button>
        </div>
    </form>
</div>
@endsection

