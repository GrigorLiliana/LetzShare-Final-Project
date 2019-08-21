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
                <img src="{{URL::asset($photo->user_photo)}}" class="rounded-circle mr-3" height="50px" width="50px"
                    alt="avatar">

                <!-- Content -->
                <div>

                    <!-- Title -->
                    <h6 class="card-title font-weight-bold mb-2 text-capitalize">{{ $photo->image_title }}</h6>
                    <!-- Subtitle -->
                    <p class="card-text"><small><i class="far fa-calendar-alt"></i>
                            {{date('d-m-Y', strtotime($photo->created_at)) }}
                        </small></p>

                </div>

            </div>

            <!-- Card image -->
            <div class="view overlay">
                <a href="{{ $photo->image_URL }}" data-fancybox="gallery" data-caption="<p>{{ $photo->image_description }}</p><hr><ul><li>
                            <i class='fas fa-map-marker-alt'></i>
                            <span>{{ $photo->locality_name }}</span>
                        </li><li><i class='fas fa-heart'></i>
                            <span>{{ $photo->likes_sum }}</span></li><li><i class='{{ $photo->category_icon }}'></i>
                            <span class='text-capitalize'>{{ $photo->category_name }}</span></li></ul>">
                    <img class="card-img-top rounded-0" src="{{ $photo->image_URL }}" alt="{{ $photo->image_title }}">
                    <div class="mask rgba-white-slight"></div>
                </a>
            </div>

            <!-- Card content -->
            <div class="card-body">

                <div class="collapse-content">

                    <!-- Text -->
                    <p class="card-text collapse text-capitalize" id="collapseContent">
                        {{ $photo->image_description }}</p>
                    <!-- Button -->
                    <ul>
                        <li>
                            <i class="fas fa-heart"></i>
                            <span>{{ $photo->likes_sum }}</span>
                        </li>
                        <li>
                            <i class="fas fa-map-marker-alt"></i>
                            <span>{{ $photo->locality_name }}</span>
                        </li>
                        <li>
                            <i class="{{ $photo->category_icon }}"></i>
                            <span class="text-capitalize">{{ $photo->category_name }}</span>
                        </li>
                    </ul>

                </div>

            </div>

        </div>
        @endforeach
        <!-- END Card -->

    </div>
</div>

@endsection
