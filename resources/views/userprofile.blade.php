@extends('layouts.app')

@section('title')
{{$userPhotos[0]->name}} Profile
@endsection

@section('content')



<h2>{{$userPhotos[0]->name}}</h2>
<hr>
<div class="card promoting-card card-user">
<?php $userAvatar = URL::asset($userPhotos[0]->user_photo); ?>
<!-- Avatar -->
<div class="profile-flex">
<img src="{{$userAvatar}}" class="rounded-circle mr-3 user-profile"
height="150px" width="150px" alt="avatar">
<div>
    @if($userPhotos[0]->user_description)
        <p><i>"{{$userPhotos[0]->user_description}}"<i></p>
    @endif
    @if($userPhotos[0]->user_location)
        <p><i class="fas fa-map-marker-alt"></i> {{$userPhotos[0]->user_location}}</p>
    @endif
<a href="mailto:{{$userPhotos[0]->email}}">Send an e-email</a>
</div>
</div>
</div>
<h2>Portfolio</h2>
<hr>
<div class="row">
    <div class="card-columns">
@foreach ($userPhotos as $userPhoto)
        @php
            $path = URL::asset($userPhoto->image_URL);
            $cat = App\Category::where('category_id', $userPhoto->category_id)->first();
            $loc = App\Location::where('locality_id', $userPhoto->locality_id)->first();
        @endphp

        <div class="card promoting-card">

            <!-- Card content -->
            <div class="card-body d-flex flex-row">

                <!-- Content -->
                <div>

                    <!-- Title -->
                    <h6 class="card-title font-weight-bold mb-2">{{ $userPhoto->image_title }}</h6>
                    <!-- Subtitle -->
                    <p class="card-text"><i class="far fa-clock pr-2"></i>{{ $userPhoto->created_at }}</p>

                </div>

            </div>

            <!-- Card image -->
            <div class="view overlay">
                <a href="{{ $path }}">
                <img class="card-img-top rounded-0" src="{{ $path }}" alt="{{ $userPhoto->image_title }}">
                    <div class="mask rgba-white-slight"></div>
                </a>
            </div>

            <!-- Card content -->
            <div class="card-body">

                <div class="collapse-content">

                    <!-- Text -->
                    <p class="card-text " id="collapseContent">{{ $userPhoto->image_description }}</p>
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
                            <span>{{ $cat->category_name }}</span>
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
