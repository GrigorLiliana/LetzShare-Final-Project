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
                <img src="{{URL::asset($photo->user_photo)}}" class="rounded-circle mr-3" height="50px" width="50px" alt="avatar">

                <!-- Content -->
                <div>

                    <!-- Title -->
                    <h6 class="card-title font-weight-bold mb-2">{{ $photo->image_title }}</h6>
                    <!-- Subtitle -->
                    <p class="card-text"><i class="far fa-clock pr-2"></i>{{ $photo->created_at }}</p>

                </div>

            </div>

            <!-- Card image -->
            <div class="view overlay">
                <a href="{{ $photo->image_URL }}" data-fancybox="gallery" data-caption="{{ $photo->image_description }}, {{ $photo->likes_sum }}">
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
                            <?php $cat = App\Category::where('category_id', $photo->category_id)->first(); ?>
                            <i class="{{$cat->category_icon}}">
                            </i>
                            <span> {{ $cat->category_name }}</span>
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