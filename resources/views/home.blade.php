<?php

//use DB;

?>

@extends('layouts.app')

@section('content')

<div class="container">
    <h3>Our Top Rated Photos</p>
    <div class="homePics">
        <?php
            foreach($topPics as $topPic) {
                echo "<div class='homePic'>";
                $path=URL::asset($topPic->image_URL);
                echo "<h5>$topPic->image_title</h5>
                <img class='homeGallery' src='$path' />
                <p>$topPic->image_description</p>
                </div>";
            }
            ?>
    </div>
    <br><br>
    <h3>Our Latest Photos</h3>
    <div class="homePics">
        <?php
            foreach($recentPics as $recentPic) {
                echo "<div class='homePic'>";
                $path=URL::asset($recentPic->image_URL);
                echo "<h5>$recentPic->image_title</h5>
                <img class='homeGallery' src='$path' />
                <p>$recentPic->image_description</p>
                </div>";
            }
        ?>
    </div>
    <br><br>
    <h3>Our Top Photographers</h3>
    <div class="homePics">
        <?php
            foreach($topUsers as $topUser) {
                echo "<div class='homePic'>";
                $userId=$topUser->user_id;
                $user = App\User::where('user_id' , $userId)->get();
                //$path=URL::asset($user->user_photo);
                // echo "<h5>$user->name</h5>";
                //<img class='homeGallery' src='$path' />
                //<p> $user->name has posted $topUser->total_photos photos</p>
                //</div>";
            }
        ?>
    </div>
</div>

@endsection
