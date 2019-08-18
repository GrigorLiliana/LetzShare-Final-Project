@extends('layouts.app')

@section('title', 'Photo Gallery')

@section('content')

@include('layouts.filters')

<div class="row">
    <div class="card-columns">

        <!-- Card -->
        @foreach ($photos as $photo)
        <div class="card promoting-card">

            <!-- Card content -->
            <div class="card-body d-flex flex-row">

                <!-- Avatar -->
                <img src="https://mdbootstrap.com/img/Photos/Avatars/avatar-8.jpg" class="rounded-circle mr-3"
                    height="50px" width="50px" alt="avatar">

                <!-- Content -->
                <div>

                    <!-- Title -->
                    <h6 class="card-title font-weight-bold mb-2">{{ $photo->image_title }}</h6>
                    <!-- Subtitle -->
                    <p class="card-text"><i class="far fa-clock pr-2"></i>{{ $photo->date }}</p>

                </div>

            </div>

            <!-- Card image -->
            <div class="view overlay">
                <a href="{{ $photo->image_URL }}">
                <img class="card-img-top rounded-0" src="{{ $photo->image_URL }}" alt="{{ $photo->image_title }}">
                    <div class="mask rgba-white-slight"></div>
                </a>
            </div>

            <!-- Card content -->
            <div class="card-body">

                <div class="collapse-content">

                    <!-- Text -->
                    <p class="card-text collapse" id="collapseContent">{{ $photo->image_description }}</p>
                    <!-- Button -->
                    <ul>
                        <li>
                            <i class="fas fa-heart"></i>
                            <span>{{ $photo->likes_sum }}</span></li>
                        <li>
                            <i class="fas fa-map-marker-alt"></i>
                            <span>{{ $photo->locality_name }}</span></li>
                        <li>
                            @if($photo->category_id === 1)
                            <i class="fas fa-landmark"></i>
                            <span>Culture</span>
                            @endif

                            @if($photo->category_id === 2)
                            <i class="fas fa-users"></i>
                            <span>Events</span>
                            @endif

                            @if($photo->category_id === 4)
                            <i class="fas fa-monument"></i>
                            <span>Monuments</span>
                            @endif

                            @if($photo->category_id === 5)
                            <i class="fas fa-tree"></i>
                            <span>Nature</span>
                            @endif

                            @if($photo->category_id === 6)
                            <i class="fas fa-glass-cheers"></i>
                            <span>Night Life</span>
                            @endif
                        <li>
                    </ul>

                </div>

            </div>

        </div>
        @endforeach
        <!-- END Card -->

    </div>
</div>

@endsection
