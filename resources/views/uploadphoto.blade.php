@extends('layouts.app')

@section('content')

<form id="uploadform" class="formbox" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="row justify-content-center">
        <div class="col-sm-12 col-md-10 col-lg-8">
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
                        <select name="locality" id="locality" required>
                            <option value="" disabled>Select</option>
                            @foreach ($locations as $locality)
                            <option value="{{$locality->locality_id}}">{{$locality->locality_name}}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="category">Category</label>
                        <select name="category" id="category" required>
                            <option value="" disabled>Select</option>
                            @foreach ($categories as $category)
                            <option value="{{$category->category_id}}">{{$category->category_name}}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <button type="submit" class="btn btn-primary btn-block">Upload</button>
                    </div>
                </div>

            </div>
        </div>
    </div>
</form>

@endsection