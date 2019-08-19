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
    <h3>Our Top Rated Photos</h3>

    <div class="card-deck">
        <?php
        foreach ($topPics as $topPic) {
            $path = URL::asset($topPic->image_URL);
            $cat = App\Category::where('category_id', $topPic->category_id)->first();
            $loc = App\Location::where('locality_id', $topPic->locality_id)->first(); ?>
            <div class="card">
                <img src="{{$path}}" class="card-img-top" alt="{{ $topPic->image_title }}">
                <div class="card-body">
                    <h5 class="card-title">{{ $topPic->image_title }}</h5>
                    <p class="card-text">{{ $topPic->image_description }}</p>
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
                            <p> {{ $topPic->likes_sum }}</p>
                        </div>
                        <div class="card-item">
                            <i class="far fa-heart"></i>
                            <p> Like</p>
                        </div>
                    </div>
                </div>
            </div>
        <?php } ?>
    </div>
    <br>

    <h3>Our Top Photographers</h3>

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

    <h3>Our Latest Photos</h3>

    <div class="card-deck">
        <?php
        foreach ($recentPics as $recentPic) {
            $path = URL::asset($recentPic->image_URL); ?>
            <div class="card">
                <img src="{{$path}}" class="card-img-top" alt="{{ $recentPic->image_title }}">
                <div class="card-body">
                    <h5 class="card-title">{{ $recentPic->image_title }}</h5>
                    <p class="card-text">{{ $recentPic->image_description }}</p>
                    <p class="card-text"><small class="text-muted">{{$recentPic->likes_sum}} Likes</small></p>
                        <?php if (Auth::check())
                        echo 'login';
                    else
                        echo 'who are you?'; ?>
                </div>
            </div>
        <?php } ?>
    </div>
    <br>

</div>

@endsection
