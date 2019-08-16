@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row">
        <div class="topPics">
            <p>content of topPics</p>
            <?php
            foreach($topPics as $topPic) {
                $path=URL::asset($topPic->image_URL);
                echo "<img class='homeGallery' src='$path' />";
            }
            ?>
        </div>
    </div>
    <div class="row">
        <div class="recentPics">
            <p>content of recentPics</p>
            <?php
            foreach($recentPics as $recentPic) {
                $path=URL::asset($recentPic->image_URL);
                echo "<img class='homeGallery' src='$path' />";
            }
            ?>
        </div>
    </div>
    <div class="row">
        <div class="topUsers">
            <p>content of topUsers</p>
        </div>
    </div>
</div>

@endsection
