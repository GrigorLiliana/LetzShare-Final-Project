@extends('layouts.app')

@section('title', 'Photo Gallery')

@section('content')

<div class="gallery">
    @foreach ($photos as $photo)
    <a href="{{ $photo->image_URL }}">
        <img src="{{ $photo->image_URL }}" class="gallery__img" alt="{{ $photo->image_title }}">
    </a>
    @endforeach
</div>


</div>

@endsection