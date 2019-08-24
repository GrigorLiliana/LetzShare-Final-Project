<style>
    .card-img-top {
        width: 100%;
        max-height: 200px;
        object-fit: cover;
    }

    .rounded-circle {
        margin: 0 10%;
    }
</style>
@extends('layouts.app')

@section('title', 'LetzShare | Home page')

@section('content')

<section id="home_page">
    <h1>LetzShare - The beauty of Luxembourg</h1>
</section>
<div class="container">
<section id="rated_photos">
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
                    <img src="{{$user->user_photo}}" class="rounded-circle mr-3" height="50" width="50"
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
                    <p class="card-text text-capitalize">
                        {{ str_limit($picture->image_description, 75, '...') }}
                    </p>
                    <!-- Icons Row -->
                    <ul>
                        <li>
                            <!-- code to implement like /unlike functionality in page -->
                            @if (Auth::check())
                                @php
                                $like = App\Like::where('photo_id', $picture->photo_id)->where('user_id',
                                Auth::user()->user_id)->first();
                                @endphp
                                @if ($like) <!-- Does a "like" exist in the table for this user, photo? -->
                                    @if ($like->islike) <!-- If so is it a like? -->
                                        <div class="liked" id="{{$picture->photo_id}}">
                                            @csrf
                                            <i class="fas fa-heart"></i>
                                            <span class="likes-number">{{ $picture->likes_sum }}</span>
                                        </div>
                                    @else <!-- Else is it currently a report? -->
                                        <div class="not-liked" id="{{$picture->photo_id}}">
                                            @csrf
                                            <i class="far fa-heart"></i>
                                            <span class="likes-number">{{ $picture->likes_sum }}</span>
                                        </div>
                                    @endif
                                @else <!-- Or else there isn't a like in the table i.e. not liked or reported -->
                                    <div class="not-liked" id="{{$picture->photo_id}}">
                                        @csrf
                                        <i class="far fa-heart"></i>
                                        <span class="likes-number">{{ $picture->likes_sum }}</span>
                                    </div>
                                @endif
                            @else <!-- finally, if the user is not logged on the like/report functionality is not enabled -->
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
                        <li>
                            <!-- code to implement report functionality in page -->
                            @if (Auth::check())
                                @php
                                $like = App\Like::where('photo_id' , $picture->photo_id)->where('user_id' ,
                                Auth::user()->user_id)->first();
                                @endphp
                                @if ($like) <!-- Does a "like" exist in the table for this user, photo? -->
                                    @if (!($like->islike)) <!-- If so is it a report? -->
                                    <div class="reported" id="r{{$picture->photo_id}}">
                                        @csrf
                                        <i class="fas fa-flag"></i>
                                        <!-- the show/hide of the spans are toggled by JS -->
                                        <span class="rep-text">Reported</span><span class="rep-text hide">Report</span>
                                    </div>
                                    @else <!-- Else is it currently a like? -->
                                    <div class="not-reported" id="r{{$picture->photo_id}}">
                                        @csrf
                                        <i class="far fa-flag"></i>
                                        <span class="rep-text">Report</span><span class="rep-text hide">Reported</span>
                                    </div>
                                    @endif
                                @else <!-- Or else there isn't a like in the table i.e. not liked or reported -->
                                <div class="not-reported" id="r{{$picture->photo_id}}">
                                    @csrf
                                    <i class="far fa-flag"></i>
                                    <span class="rep-text">Report</span><span class="rep-text hide">Reported</span>
                                </div>
                                @endif
                            @endif
                        </li>
                    </ul>
                </div>

            </div>

        </div>
        @endforeach
    </div>




    </section> <!-- end card deck -->
<section id="top_photographers">

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
                    <img src="{{$path}}" class="rounded-circle mr-3" width="200" alt="{{ $user->name }}">
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
</section>
<section id="latest_photos">
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
                    <img src="{{$user->user_photo}}" class="rounded-circle mr-3" height="50" width="50"
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
                    <img class="card-img-top rounded-0" src="{{ $picture->image_URL }}"
                        alt="{{ $picture->image_title }}">
                    <div class="mask rgba-white-slight"></div>
                </a>
            </div>

            <!-- Card content -->
            <div class="card-body">

                <div class="collapse-content">
                    <!-- Text -->
                    <p class="card-text ">
                        {{ str_limit($picture->image_description, 75, '...') }}</p>
                    <!-- Icons Row -->
                    <ul>
                        <li>
                            <!-- code to implement like /unlike functionality in page -->
                            @if (Auth::check())
                                @php
                                $like = App\Like::where('photo_id', $picture->photo_id)->where('user_id',
                                Auth::user()->user_id)->first();
                                @endphp
                                @if ($like) <!-- Does a "like" exist in the table for this user, photo? -->
                                    @if ($like->islike) <!-- If so is it a like? -->
                                        <div class="liked" id="{{$picture->photo_id}}">
                                            @csrf
                                            <i class="fas fa-heart"></i>
                                            <span class="likes-number">{{ $picture->likes_sum }}</span>
                                        </div>
                                    @else <!-- Else is it currently a report? -->
                                        <div class="not-liked" id="{{$picture->photo_id}}">
                                            @csrf
                                            <i class="far fa-heart"></i>
                                            <span class="likes-number">{{ $picture->likes_sum }}</span>
                                        </div>
                                    @endif
                                @else <!-- Or else there isn't a like in the table i.e. not liked or reported -->
                                    <div class="not-liked" id="{{$picture->photo_id}}">
                                        @csrf
                                        <i class="far fa-heart"></i>
                                        <span class="likes-number">{{ $picture->likes_sum }}</span>
                                    </div>
                                @endif
                            @else <!-- finally, if the user is not logged on the like/report functionality is not enabled -->
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
                        <li>
                            <!-- code to implement report functionality in page -->
                            @if (Auth::check())
                                @php
                                $like = App\Like::where('photo_id' , $picture->photo_id)->where('user_id' ,
                                Auth::user()->user_id)->first();
                                @endphp
                                @if ($like) <!-- Does a "like" exist in the table for this user, photo? -->
                                    @if (!($like->islike)) <!-- If so is it a report? -->
                                    <div class="reported" id="r{{$picture->photo_id}}">
                                        @csrf
                                        <i class="fas fa-flag"></i>
                                        <!-- the show/hide of the spans are toggled by JS -->
                                        <span class="rep-text">Reported</span><span class="rep-text hide">Report</span>
                                    </div>
                                    @else <!-- Else is it currently a like? -->
                                    <div class="not-reported" id="r{{$picture->photo_id}}">
                                        @csrf
                                        <i class="far fa-flag"></i>
                                        <span class="rep-text">Report</span><span class="rep-text hide">Reported</span>
                                    </div>
                                    @endif
                                @else <!-- Or else there isn't a like in the table i.e. not liked or reported -->
                                <div class="not-reported" id="r{{$picture->photo_id}}">
                                    @csrf
                                    <i class="far fa-flag"></i>
                                    <span class="rep-text">Report</span><span class="rep-text hide">Reported</span>
                                </div>
                                @endif
                            @endif
                        </li>
                    </ul> <!-- end of icons row -->
                </div> <!-- end of collapse content div -->
            </div> <!-- end of card body div -->
        </div> <!-- end of card div -->
        @endforeach
    </div> <!-- end card deck -->
</section></div>
@endsection
