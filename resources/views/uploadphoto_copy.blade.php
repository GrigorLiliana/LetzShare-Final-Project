
@extends('layouts.app')

@section('pageTitle', 'Upload a photo | LetzShare')

@section('content')

<div class="container">
    <button>
        <a href="{{route('useraccount')}}">My account</a>
    </button>
    <form class="formbox" method="POST" enctype="multipart/form-data">
    @csrf
        <div class="col-md-6 offset-3">
            <div class="card">
                <div class="card-header">
                    <h3>Upload photo</h3>
                </div>
                <div class="card-body">
                    <div class="form-group">
                        <label for="image">Select an amazing image </label>
                            <div class="custom-file">
                                <label class="" for="customFile"></label>
                                <input type="file" name="image" class="" id="customFile" required>
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
                            <option value="" selected disabled>Select</option>
                            
                            @foreach ($locations as $locality)
                                <option value="">{{$locality->locality_name}}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="category">Category</label>
                        <select name="category" id="category" required>
                            <option value="" selected disabled>Select</option>
                            
                            @foreach ($categories as $category)
                                <option value="">{{$category->category_name}}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <button type="submit" class="btn btn-primary btn-block">Upload</button>
                    </div>
                </div>

            </div>
        </div>
    </form>
</div>
@endsection
