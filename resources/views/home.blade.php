@extends('layouts.app')

@section('content')
<div class="container">
    <h1>LetzShare - The beauty of Luxembourg</h1>
    <p id="blurb">LetzShare is a website for users to upload and share photographs of Luxembourg. These can be rated and commented upon by other users and the site will keep track of the most liked photos. Luxembourg is a small country nestling between France, Germany and Belgium and is not so well known outside the region.</p>
    <p id="blurb">By creating a platform to showcase attractive images of the Grand Duchy we hope to play a role in elevating its profile. Rich in history with many monuments and historic buildings this small country is also favoured by many attractive natural landscapes and beauty spots.</p>
    <p id="blurb">As well as this Luxembourg has its own unique culture and hugely diverse and multicultural population with a vibrant culture and nightlife reflecting this.
        Letzshare will be the platform which allows users to share images of all these aspects of Luxembourg.</p>
    <br>
</div>
<div class="container">
    <h3>Top Rated Photos</h3>

    <div class="card-deck">
        <?php
        foreach ($topPics as $topPic) {
            $path = URL::asset($topPic->image_URL);
            $user = App\User::where('user_id', $topPic->user_id)->first();
            $cat = App\Category::where('category_id', $topPic->category_id)->first();
            $loc = App\Location::where('locality_id', $topPic->locality_id)->first(); ?>

        <div class="card promoting-card">
            <!-- Card content -->
            <div class="card-body d-flex flex-row">
                <!-- Avatar -->
                <img src="{{$user->user_photo}}" class="rounded-circle mr-3"
                    height="50px" width="50px" alt="photographer avatar">
                <!-- Content -->
                <div>
                    <!-- Title -->
                    <h6 class="card-title font-weight-bold mb-2">{{ $topPic->image_title }}</h6>
                    <!-- Subtitle -->
                    <p class="card-text"><i class="far fa-clock pr-2"></i>{{ $topPic->created_at }}</p>
                </div>
            </div>

            <!-- Card image -->
            <div class="view overlay">
                <a href="{{ $topPic->image_URL }}">
                <img class="card-img-top rounded-0" src="{{ $topPic->image_URL }}" alt="{{ $topPic->image_title }}">
                    <div class="mask rgba-white-slight"></div>
                </a>
            </div>

            <!-- Card content -->
            <div class="card-body">

                <div class="collapse-content">
                    <!-- Text -->
                    <p class="card-text " id="collapseContent">{{ $topPic->image_description }}</p>
                    <!-- Button -->
                    <ul>
                        <li>
                            <i class="fas fa-heart"></i>
                            <span>{{ $topPic->likes_sum }}</span>
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
        <?php } ?>
    </div> <!-- end card deck -->
    <br>

    <h3>Top Photographers</h3>

    <div class="card-deck">
        <?php
        foreach ($topUsers as $topUser) {
            $userId = $topUser->user_id;
            $user = App\User::where('user_id', $userId)->first();
            $path = URL::asset($user->user_photo); ?>
            <div class="card">
                <img src="{{$path}}" class="card-img-top" alt="{{ $user->name }}">
                <div class="card-body">
                    <h5 class="card-title">{{ $user->name }}</h5>
                    <p class="card-text">{{ $topPic->user_description }}</p>
                    <p class="card-text"><small class="text-muted">Has possted {{$topUser->total_photos}} photos</small></p>
                </div>
            </div>
        <?php } ?>
    </div>
    <br>

    <h3>Latest Photos</h3>

    <div class="card-deck">
        <?php
        foreach ($recentPics as $recentPic) {
            $path = URL::asset($recentPic->image_URL);
            $cat = App\Category::where('category_id', $recentPic->category_id)->first();
            $loc = App\Location::where('locality_id', $recentPic->locality_id)->first(); ?>
            <div class="card">
                <img src="{{$path}}" class="card-img-top" alt="{{ $recentPic->image_title }}">
                <div class="card-body">
                    <h5 class="card-title">{{ $recentPic->image_title }}</h5>
                    <p class="card-text">{{ $recentPic->image_description }}</p>
                    <div class="card-row">
                        <div class="card-item">
                            <i class="{{$cat->category_icon}}"></i>
                            <p> {{ $cat->category_name }}</p>
                        </div>
                        <div class="card-item">
                            <i class="fas fa-map-marker-alt"></i>
                            <p> {{ $loc->locality_name }}</p>
                        </div>
                    </div>
                    <div class="card-row">
                        <div class="card-item">
                            <i class="fas fa-heart"></i>
                            <p> {{ $recentPic->likes_sum }} </p>
                        </div>
                        <?php if (Auth::check()) {
                            $like = App\Like::where('photo_id' , $recentPic->photo_id)->where('user_id' , Auth::user()->user_id)->first();
                            if ($like)
                            echo '<div class="card-item" id="unlike">
                                <i class="far fa-thumbs-down"></i>
                                <p> Unlike</p>
                            </div>';
                            else
                            echo '<div class="card-item" id="like">
                                <i class="far fa-heart"></i>
                                <p> Like</p>
                            </div>';
                        } ?>
                    </div>

                </div>
            </div> <!-- end individual card -->
        <?php } ?>
    </div> <!-- end card deck -->
    <br>

</div> <!-- end container -->

@endsection
