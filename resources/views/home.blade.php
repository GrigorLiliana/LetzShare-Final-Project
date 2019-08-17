@extends('layouts.app')

@section('content')

<div class="container">

    <div class="jumbotron">
        <h1 class="display-4">LetzShare</h1>
        <p class="lead">The beauty of Luxembourg</p>
        <hr class="my-4">
        <p class="blurb">LetzShare is a website for users to upload and share photographs of Luxembourg. These can be rated and commented upon by other users and the site will keep track of the most liked photos. Luxembourg is a small country nestling between France, Germany and Belgium and is not so well known outside the region.</p>
        <p class="blurb">By creating a platform to showcase attractive images of the Grand Duchy we hope to play a role in elevating its profile. Rich in history with many monuments and historic buildings this small country is also favoured by many attractive natural landscapes and beauty spots.</p>
        <p class="blurb">As well as this Luxembourg has its own unique culture and hugely diverse and multicultural population with a vibrant culture and nightlife reflecting this. Letzshare will be the platform which allows users to share images of all these aspects of Luxembourg.</p>
    </div>

    <div>
        <div class="row">
            <h3>Our Top Rated Photos</h3>
            <div class="topPics">
                @foreach ($topPics as $topPic)
                <div class="col-sm-12 col-md-6 col-lg-4">
                    <div class="card">
                        <img src="{{ URL::asset($topPic->image_URL) }}" class="card-img-top" alt="...">
                        <div class="card-body">
                          <h5 class="card-title">{{ $topPic->image_title }}</h5>
                            <p class="card-text">{{ $topPic->image_description }}</p>
                            <div>
                                <i class="fas fa-thumbs-up"></i>
                                {{ $topPic->likes_sum }}
                            </div>
                            @if (Auth::check())
                                <a href="#" class="btn btn-primary">Edit</a>   
                            @endif
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
    
    <div>
        <div class="row">
            <h3>Our Top Photographers</h3>
            <div class="topUsers">
                @foreach ($topUsers as $topUser)
                @php
                    $userId = $topUser->user_id;
                    $user = App\User::where('user_id', $userId)->first();
                @endphp
                <div class="col-sm-12 col-md-6 col-lg-4">
                    <div class="card">
                        <img src="{{ URL::asset($user->user_photo) }}" class="card-img-top" alt="...">
                        <div class="card-body">
                          <h5 class="card-title">{{ $user->name }}</h5>
                            <p class="card-text">{{-- {{ $topUser->image_description }} --}}</p>
                            <div>
                                <i class="fas fa-images"></i>
                                <span>has posted {{ $topUser->total_photos }} photos</span>
                            </div>
                            @if (Auth::check())
                                <a href="#" class="btn btn-primary">Edit</a>   
                            @endif
                        </div>
                      </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
    
    <div>
        <div class="row">
            <h3>Our Latest Photos</h3>
            <div class="recentPics">
                @foreach ($recentPics as $recentPic)
                <div class="col-sm-12 col-md-6 col-lg-4">
                    <div class="card">
                        <img src="{{ URL::asset($recentPic->image_URL) }}" class="card-img-top" alt="...">
                        <div class="card-body">
                            <h5 class="card-title">{{ $topPic->image_title }}</h5>
                            <p class="card-text">{{ $topPic->image_description }}</p>
                            <div>
                                <i class="fas fa-thumbs-up"></i>
                                {{ $topPic->likes_sum }}
                            </div>
                            @if (Auth::check())
                                <a href="#" class="btn btn-primary">Edit</a>   
                            @endif
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div> <!-- /container-->

@endsection
