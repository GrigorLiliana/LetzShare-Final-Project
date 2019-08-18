@extends('layouts.app')

@section('pageTitle', 'Photo Gallery | LetzShare')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-sm">
            @foreach ($photos as $photo)
            <div class="card mb-3">
                <a href="{{ $photo->image_URL }}" class="img-wrap"><img src="{{ $photo->image_URL }}" class="card-img-top" alt="{{ $photo->image_title }}">
                    <div class="card-body">
                        <h5 class="card-title">{{ $photo->image_title }}</h5>
                        <p class="card-text">{{ $photo->image_description }}</p>
                        <p class="card-text">Author: <em>&mdash; {{ $photo->name }}</em></p>
                        <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p>
                        <ul>
                            <li><i class="fas fa-heart"></i><span>{{ $photo->likes_sum }}</span></li>
                            <li><i class="fas fa-map-marker-alt"></i><span>{{ $photo->locality_id }}</span></li>
                            <li>
                                @if($photo->category_id === 1)
                                <i class="fas fa-landmark"></i><span>Culture</span>
                                @endif

                                @if($photo->category_id === 2)
                                <i class="fas fa-users"></i><span>Events</span>
                                @endif

                                @if($photo->category_id === 4)
                                <i class="fas fa-monument"></i><span>Monuments</span>
                                @endif

                                @if($photo->category_id === 5)
                                <i class="fas fa-tree"></i><span>Nature</span>
                                @endif

                                @if($photo->category_id === 6)
                                <i class="fas fa-glass-cheers"></i><span>Night Life</span>
                                @endif
                            <li>
                        </ul>
                    </div>
            </div>
            @endforeach
        </div>
    </div>
</div>

@endsection