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
    <div class="row">
        <?php
        foreach ($topPics as $topPic) {
            echo "<div class='col-sm'>";
            $path = URL::asset($topPic->image_URL);
            echo "<h5>$topPic->image_title</h5>
                <img class='homeGallery' src='$path' />
                <p>$topPic->image_description</p>
                <p>$topPic->likes_sum likes</p>
                </div>";
            if (Auth::check())
                echo 'login';
        }
        ?>
    </div>
    <h3>Our Top Photographers</h3>
    <div class="row">
        <?php
        foreach ($topUsers as $topUser) {
            echo "<div class='col-sm'>";
            $userId = $topUser->user_id;
            $user = App\User::where('user_id', $userId)->first();

            $path = URL::asset($user->user_photo);
            echo "<h5>$user->name</h5>
                <img class='homeGallery' src='$path' />
                <p> $user->name has posted $topUser->total_photos photos</p>
                </div>";
        }
        ?>
    </div>
    <h3>Our Latest Photos</h3>
    <div class="row">
        <?php
        foreach ($recentPics as $recentPic) {
            echo "<div class='col-sm'>";
            $path = URL::asset($recentPic->image_URL);
            echo "<h5>$recentPic->image_title</h5>
                <img class='homeGallery' src='$path' />
                <p>$recentPic->image_description</p>
                <p>$recentPic->likes_sum likes</p>
                </div>";
        }
        ?>
    </div>
</div>

@endsection
