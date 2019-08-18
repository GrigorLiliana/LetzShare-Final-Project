@extends('layouts.app')

@section('title', 'Photo Gallery')

@section('content')

<div class="container">
    <div class="row">
            @foreach ($photos as $photo)
            <div class="col-sm-12 col-md-6 col-lg-4">
                <div class="card mb-3">
                    <a href="{{ $photo->image_URL }}" class="img-wrap">
                        <img src="{{ $photo->image_URL }}" class="card-img-top" alt="{{ $photo->image_title }}">
                    </a>
                        <div class="card-body">
                            <h5 class="card-title">{{ $photo->image_title }}</h5>
                            <p class="card-text">{{ $photo->image_description }}</p>
                            <p class="card-text">Author: <em>&mdash; {{ $photo->name }}</em></p>
                            
                            <ul>
                                <li><i class="fas fa-heart"></i>&nbsp;<span>{{ $photo->likes_sum }}</span></li>
                                <li><i class="fas fa-map-marker-alt"></i>&nbsp;<span>{{ $photo->locality_id }}</span></li>
                                <li>
                                    @if($photo->category_id === 1)
                                    <i class="fas fa-landmark"></i>&nbsp;<span>Culture</span>
                                    @endif
    
                                    @if($photo->category_id === 2)
                                    <i class="fas fa-users"></i>&nbsp;<span>Events</span>
                                    @endif
    
                                    @if($photo->category_id === 4)
                                    <i class="fas fa-monument"></i>&nbsp;<span>Monuments</span>
                                    @endif
    
                                    @if($photo->category_id === 5)
                                    <i class="fas fa-tree"></i>&nbsp;<span>Nature</span>
                                    @endif
    
                                    @if($photo->category_id === 6)
                                    <i class="fas fa-glass-cheers"></i>&nbsp;<span>Night Life</span>
                                    @endif
                                <li>
                            </ul>
                        </div>
                        @if (auth()->user()->isAdmin === 1)
                        <div class="card-footer text-muted">
                            <small class="text-muted">Photo ID: {{ $photo->photo_id }}</small>
                            <small class="text-muted">Category ID: {{ $photo->category_id }}</small>
                            <small class="text-muted">Locality ID: {{ $photo->locality_id }}</small>
                        </div>
                        @endif
                </div>
            </div>
            @endforeach
    </div>
</div>

@endsection