@extends('layouts.app')

@section('content')
<div class="container">
    <h1>LetzShare - The beauty of Luxembourg</h1>
    <p id="blurb">LetzShare is a website for users to upload and share photographs of Luxembourg. These can be rated and
        commented upon by other users and the site will keep track of the most liked photos. Luxembourg is a small
        country nestling between France, Germany and Belgium and is not so well known outside the region.</p>
    <p id="blurb">By creating a platform to showcase attractive images of the Grand Duchy we hope to play a role in
        elevating its profile. Rich in history with many monuments and historic buildings this small country is also
        favoured by many attractive natural landscapes and beauty spots.</p>
    <p id="blurb">As well as this Luxembourg has its own unique culture and hugely diverse and multicultural population
        with a vibrant culture and nightlife reflecting this.
        Letzshare will be the platform which allows users to share images of all these aspects of Luxembourg.</p>
    <br>
</div>
<div class="container">
    <h3>Top Rated Photos</h3>

    <div class="card-deck">
        @foreach ($topPics as $picture)
            @php
                $path = URL::asset($picture->image_URL);
                $user = App\User::where('user_id', $picture->user_id)->first();
                $cat = App\Category::where('category_id', $picture->category_id)->first();
                $loc = App\Location::where('locality_id', $picture->locality_id)->first();
            @endphp
        <div class="card promoting-card">
            <!-- Card content -->
            <div class="card-body d-flex flex-row">
                <!-- Avatar -->
                <a href="/userprofile/{{$user->user_id}}">
                    <img src="{{$user->user_photo}}" class="rounded-circle mr-3" height="50px" width="50px"
                        alt="{{$user->name}}">
                </a>
                <!-- Content -->
                <div>
                    <!-- Title -->
                    <h6 class="card-title font-weight-bold mb-2 text-capitalize">{{ $picture->image_title }}</h6>
                    <!-- Subtitle -->
                    <p class="card-text"><small><i class="far fa-calendar-alt"></i>
                            {{$picture->created_at->format('d-m-Y') }}</small></p>
                </div>
            </div>

            <!-- Card image -->
            <div class="view overlay">
                <a href="{{ $picture->image_URL }}">
                    <img class="card-img-top rounded-0" src="{{ $picture->image_URL }}"
                        alt="{{ $picture->image_title }}">
                    <div class="mask rgba-white-slight"></div>
                </a>
            </div>

            <!-- Card content -->
            <div class="card-body">

                <div class="collapse-content">
                    <!-- Text -->
                    <p class="card-text text-capitalize" id="collapseContent">
                        {{ str_limit($picture->image_description, 75, '...') }}
                    </p>
                    <!-- Button -->
                    <ul>
                        <li>
                            @if (Auth::check())
                            @php
                            $like = App\Like::where('photo_id', $picture->photo_id)->where('user_id', Auth::user()->user_id)->first();
                            @endphp
                            @if ($like)
                            <div class="liked" id="{{$picture->photo_id}}">
                                @csrf
                                <i class="fas fa-heart"></i>
                                <span>{{ $picture->likes_sum }}</span>
                            </div>
                            @else
                            <div class="not-liked" id="{{$picture->photo_id}}">
                                @csrf
                                <i class="far fa-heart"></i>
                                <span>{{ $picture->likes_sum }}</span>
                            </div>
                            @endif
                            @else
                            <div class="not-logged">
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
                            <span class="text-capitalize">{{ $cat->category_name }}</span>
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
        @foreach ($topUsers as $topUser)
        @php
        $userId = $topUser->user_id;
        $user = App\User::where('user_id', $userId)->first();
        $path = URL::asset($user->user_photo);
        @endphp
        <div class="card">
            <div class="card-body d-flex flex-row">
                <h6 class="card-title font-weight-bold mb-2 text-capitalize">{{ $user->name }}</h6>
            </div>
            <div class="view overlay">
                <a href="/userprofile/{{$user->user_id}}">
                    <img src="{{$path}}" class="rounded-circle mr-3" height="200px" width="200px"
                        alt="{{ $user->name }}">
                </a>
            </div>
            <div class="card-body">
                <p class="card-text text-capitalize"><small>{{ str_limit($user->user_description, 90, '...') }}</small>
                </p>
                <p class="card-text"><small class="text-muted">Has posted {{$topUser->total_photos}} photos</small></p>
            </div>
        </div>
        @endforeach
    </div>
</div>
<br>

<h3>Latest Photos</h3>

<div class="card-deck">
    @foreach ($recentPics as $picture)
    @php
    $path = URL::asset($picture->image_URL);
    $user = App\User::where('user_id', $picture->user_id)->first();
    $cat = App\Category::where('category_id', $picture->category_id)->first();
    $loc = App\Location::where('locality_id', $picture->locality_id)->first();
    @endphp

    <div class="card promoting-card">
        <!-- Card content -->
        <div class="card-body d-flex flex-row">
            <!-- Avatar -->
            <a href="/userprofile/{{$user->user_id}}">
                <img src="{{$user->user_photo}}" class="rounded-circle mr-3" height="50px" width="50px"
                    alt="{{$user->name}}">
            </a>
            <!-- Content -->
            <div>
                <!-- Title -->
                <h6 class="card-title font-weight-bold mb-2 text-capitalize">{{ $picture->image_title }}</h6>
                <!-- Subtitle -->
                <p class="card-text"><small><i class="far fa-calendar-alt"></i>
                        {{ $picture->created_at->format('d-m-Y') }}</small></p>
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
                <p class="card-text " id="collapseContent text-capitalize">
                    {{ str_limit($picture->image_description, 75, '...') }}</p>
                <!-- Button -->
                <ul>
                    <li>
                        @if (Auth::check())
                        @php
                        $like = App\Like::where('photo_id' , $picture->photo_id)->where('user_id' ,
                        Auth::user()->user_id)->first();
                        @endphp
                        @if ($like)
                        <div class="liked" id="{{$picture->photo_id}}">
                            @csrf
                            <i class="fas fa-heart"></i>
                            <span>{{ $picture->likes_sum }}</span>
                        </div>
                        @else
                        <div class="not-liked" id="{{$picture->photo_id}}">
                            @csrf
                            <i class="far fa-heart"></i>
                            <span>{{ $picture->likes_sum }}</span>
                        </div>
                        @endif
                        @else
                        <div class="not-logged">
                            <i class="far fa-heart"></i>
                            <span>{{ $picture->likes_sum }}</span>
                        </div>
                        @endif
                    </li>
                    <li>
                        <i class="fas fa-map-marker-alt"></i><span> {{ $loc->locality_name }}</span>
                    </li>
                    <li>
                        <i class="{{$cat->category_icon}}"></i><span class="text-capitalize">
                            {{ $cat->category_name }}</span>
                    </li>
                </ul>
            </div>

        </div>

    </div>
    @endforeach
</div> <!-- end card deck -->
<br>

</div> <!-- end container -->

<script>
    let urlLike = '{{route('like')}}';
</script>

@endsection
