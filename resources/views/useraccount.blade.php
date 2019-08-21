@extends('layouts.app')
@section('title')
{{ Auth::user()->name }} Account
@endsection

@section('content')
<h2 class="text-capitalize">{{ Auth::user()->name }}, welcome to your dashboard!</h2>
<div>
    <p>
        <a href="{{route('uploadphoto')}}" class="add">
            Upload new photo <i class="fas fa-plus-circle"></i>
        </a>
    </p>
</div>

<!-- Card -->
<div class="row">
    <div class="card-columns">
        @foreach ($userPhotos as $userPhoto)

        <?php
            $path = URL::asset($userPhoto->image_URL);
            $userAvatar = URL::asset(Auth::user()->user_photo);
            $cat = App\Category::where('category_id', $userPhoto->category_id)->first();
            $loc = App\Location::where('locality_id', $userPhoto->locality_id)->first(); ?>

        <div class="card promoting-card">

            <!-- Card content -->
            <div class="card-body d-flex flex-row">

                <!-- Avatar -->
                <img src="{{$userAvatar}}" class="rounded-circle mr-3" height="50px" width="50px" alt="avatar">

                <!-- Content -->
                <div>

                    <!-- Title -->
                    <h6 class="card-title font-weight-bold mb-2 text-capitalize">{{ $userPhoto->image_title }}</h6>
                    <!-- Subtitle -->
                    <p class="card-text">
                        <small>
                            <i class="far fa-calendar-alt"></i>
                            {{ date('d-m-Y', strtotime($userPhoto->photodate)) }}
                        </small>
                    </p>

                </div>

            </div>

            <!-- Card image -->
            <div class="view overlay">
                <a href="{{ $userPhoto->image_URL }}">
                    <img class="card-img-top rounded-0" src="{{ $userPhoto->image_URL }}"
                        alt="{{ $userPhoto->image_title }}">
                    <div class="mask rgba-white-slight"></div>
                </a>
            </div>

            <!-- Card content -->
            <div class="card-body">

                <div class="collapse-content">

                    <!-- Text -->
                    <p class="card-text text-capitalize" id="collapseContent">
                        {{ str_limit($userPhoto->image_description, 90, '...') }}</p>
                    <!-- Button -->
                    <ul>
                        <li>
                            <i class="fas fa-heart"></i>
                            <span>{{ $userPhoto->likes_sum }}</span>
                        </li>
                        <li>
                            <i class="fas fa-map-marker-alt"></i>
                            <span>{{ $loc->locality_name }}</span>
                        </li>
                        <li>
                            <i class="{{$cat->category_icon}}">
                            </i>
                            <span class="text-capitalize">{{ $cat->category_name }}</span>
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
