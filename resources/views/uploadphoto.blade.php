
@extends('layouts.app')

@section('content')

<div class="container">
<button><a href="{{route('useraccount')}}">My account</a></button>
    <form class="formbox" enctype="multipart/form-data">
        <div class="col-md-6 offset-3">
            <h3>Upload photo</h2>
            <div class="form-group">
                <input type="file" name="image" class="form-control">
            </div>
            <div class="form-group">
                <label for="title">Title</label>
                <input type="text" class="form-control" id="title" name="title" placeholder="Enter the photo title" required>
            </div>
            <div class="form-group">
                <label for="description">Description</label>
                <textarea class="form-control" id="description" name="description" rows="3" placeholder="This is an amazin photo taked by {{ Auth::user()->name }}" required></textarea>
            </div>
            <div class="form-group">
                <label for="subject">Subject</label>
                <input type="text" class="form-control" id="subject" name="subject" placeholder="Password" required>
            </div>
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
