
@extends('layouts.app')

@section('content')

<div class="container">
<button><a href="{{route('useraccount')}}">My account</a></button>
    <form class="formbox" enctype="multipart/form-data">
        <div class="col-md-6 offset-3">
            <h3>Upload photo</h2>
            <div class="form-group">
            <label for="image">Select an amazing image </label>
            <div class="custom-file">
            <input type="file" class="custom-file-input" id="customFile">
            <label class="custom-file-label" for="customFile">Choose file</label>
            </div>
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
                <label for="locality">Locality</label>
                <select name="locatily" id="locatily" required>
                    <option value="">Belval</option>
                </select>
                <label for="category">Category</label>
                <select name="category" id="category" required>
                    <option value="">Nature</option>
                </select>
            </div>

            <button type="submit" class="btn btn-primary btn-block">Upload</button>
        </div>
    </form>
</div>
@endsection
