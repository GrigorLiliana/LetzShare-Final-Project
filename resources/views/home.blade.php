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
        @foreach ($topPics as $picture)
            <?php
            $path = URL::asset($picture->image_URL);
            $user = App\User::where('user_id', $picture->user_id)->first();
            $cat = App\Category::where('category_id', $picture->category_id)->first();
            $loc = App\Location::where('locality_id', $picture->locality_id)->first(); ?>

        <div class="card promoting-card">
            <!-- Card content -->
            <div class="card-body d-flex flex-row">
                <!-- Avatar -->
                <img src="{{$user->user_photo}}" class="rounded-circle mr-3"
                    height="50px" width="50px" alt="photographer avatar">
                <!-- Content -->
                <div>
                    <!-- Title -->
                    <h6 class="card-title font-weight-bold mb-2">{{ $picture->image_title }}</h6>
                    <!-- Subtitle -->
                    <p class="card-text"><i class="far fa-clock pr-2"></i>{{ $picture->created_at }}</p>
                </div>
            </div>

            <!-- Card image -->
            <div class="view overlay">
                <a href="{{ $picture->image_URL }}">
                <img class="card-img-top rounded-0" src="{{ $picture->image_URL }}" alt="{{ $picture->image_title }}">
                    <div class="mask rgba-white-slight"></div>
                </a>
            </div>

            <!-- Card content -->
            <div class="card-body">

                <div class="collapse-content">
                    <!-- Text -->
                    <p class="card-text " id="collapseContent">{{ $picture->image_description }}</p>
                    <!-- Button -->
                    <ul>
                        <li>
                        @if (Auth::check())
                            <?php
                            $like = App\Like::where('photo_id' , $picture->photo_id)->where('user_id' , Auth::user()->user_id)->first();
                            ?>
                            @if ($like)
                                <div class="liked" id="logged">
                                <i class="fas fa-heart"></i>
                                <span>{{ $picture->likes_sum }}</span>
                                </div>
                            @else
                                <div class="not-liked" id="logged">
                                <i class="far fa-heart"></i>
                                <span>{{ $picture->likes_sum }}</span>
                                </div>
                            @endif
                        @else
                            <div class="not-liked" id="not-logged">
                            <i class="far fa-heart"></i>
                            <span>{{ $picture->likes_sum }}</span>
                            </div>
                        @endif
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
                    <p class="card-text">{{ $picture->user_description }}</p>
                    <p class="card-text"><small class="text-muted">Has possted {{$topUser->total_photos}} photos</small></p>
                </div>
            </div>
        </div>
        <?php } ?>
    </div>
    <br>

    <h3>Latest Photos</h3>

    <div class="card-deck">
    @foreach ($recentPics as $picture)
            <?php
            $path = URL::asset($picture->image_URL);
            $user = App\User::where('user_id', $picture->user_id)->first();
            $cat = App\Category::where('category_id', $picture->category_id)->first();
            $loc = App\Location::where('locality_id', $picture->locality_id)->first(); ?>

        <div class="card promoting-card">
            <!-- Card content -->
            <div class="card-body d-flex flex-row">
                <!-- Avatar -->
                <img src="{{$user->user_photo}}" class="rounded-circle mr-3"
                    height="50px" width="50px" alt="photographer avatar">
                <!-- Content -->
                <div>
                    <!-- Title -->
                    <h6 class="card-title font-weight-bold mb-2">{{ $picture->image_title }}</h6>
                    <!-- Subtitle -->
                    <p class="card-text"><i class="far fa-clock pr-2"></i>{{ $picture->created_at }}</p>
                </div>

            </div>

            <!-- Card image -->
            <div class="view overlay">
                <a href="{{ $picture->image_URL }}">
                <img class="card-img-top rounded-0" src="{{ $picture->image_URL }}" alt="{{ $picture->image_title }}">
                    <div class="mask rgba-white-slight"></div>
                </a>
            </div>

            <!-- Card content -->
            <div class="card-body">

                <div class="collapse-content">
                    <!-- Text -->
                    <p class="card-text " id="collapseContent">{{ $picture->image_description }}</p>
                    <!-- Button -->
                    <ul>
                        <li>
                        @if (Auth::check())
                            <?php
                            $like = App\Like::where('photo_id' , $picture->photo_id)->where('user_id' , Auth::user()->user_id)->first();
                            ?>
                            @if ($like)
                                <div class="liked" id="logged">
                                <i class="fas fa-heart"></i>
                                <span>{{ $picture->likes_sum }}</span>
                                </div>
                            @else
                                <div class="not-liked" id="logged">
                                <i class="far fa-heart"></i>
                                <span>{{ $picture->likes_sum }}</span>
                                </div>
                            @endif
                        @else
                            <div class="not-liked" id="not-logged">
                            <i class="far fa-heart"></i>
                            <span>{{ $picture->likes_sum }}</span>
                            </div>
                        @endif
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
    </div> <!-- end card deck -->
    <br>

</div> <!-- end container -->

@endsection