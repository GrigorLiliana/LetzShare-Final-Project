@extends('layouts.app')

@section('title')
{{$userPhotos[0]->name}} Profile
@endsection

@section('content')

@php
// check if the profile belongs to the user
if((Auth::user()->user_id)==($userPhotos[0]->user_id)){
$ownUser=true;
$userId=Auth::user()->user_id;
}else
$ownUser=false;
@endphp
<form action="" method="post">
    <h2>
        @if($ownUser)Hello, @endif <span class="old-name text-capitalize">{{$userPhotos[0]->name}}</span>

        @if($ownUser)<span class="old-name"> | </span><a href="#" id="editName">Edit Name</a>
        @endif
    </h2>
    <input class="hide" type="text" name="name" id="name" value="{{$userPhotos[0]->name}}"
        placeholder="{{$userPhotos[0]->name}}">
    <input class="hide" type="button" value="Edit" name="edit">
</form>
<hr>
<!-- User details -->
<div class="card promoting-card card-user">
    @php $userAvatar = URL::asset($userPhotos[0]->user_photo); @endphp
    <!-- Avatar -->
    <div class="profile-flex">
        <div class="edit-photo">
            <img src="{{$userAvatar}}" class="rounded-circle mr-3 user-profile" height="150" width="150" alt="avatar">
            @if($ownUser)<p><a href="{{route('useraccount')}}">Edit photo</a></p>@endif
        </div>
        <div>
            @if($userPhotos[0]->user_description)
            <p><i class="fas fa-comment"></i><i> "{{$userPhotos[0]->user_description}}"</i>
                @if($ownUser) | <a href="{{route('useraccount')}}">Edit Description</a></p>
            @endif
            @endif
            @if($userPhotos[0]->user_location)
            <p><i class="fas fa-map-marker-alt"></i> {{$userPhotos[0]->user_location}}
                @if($ownUser) | <a href="{{route('useraccount')}}">Edit Location</a></p>@endif
            @endif
            @if(!$ownUser)<p><a href="mailto:{{$userPhotos[0]->email}}">Send an e-email</a></p>
            @else <p><i class="fas fa-at"></i> {{$userPhotos[0]->email}}</p>
            @endif
        </div>
    </div>
</div>
<!-- End of the User details -->

<!-- User Portfolio -->
<h2>Portfolio
    @if($ownUser)|
    <a href="{{route('uploadphoto')}}" class="add">
        Upload new photo <i class="fas fa-plus-circle"></i>
    </a>
    @endif
</h2>
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
                    <h6 class="card-title font-weight-bold mb-2">{{ $userPhoto->image_title }}
                        @if($ownUser)
                        <a href="{{route('useraccount')}}"><i class="far fa-edit"></i></a>
                        <a href="{{route('useraccount')}}"><i class="far fa-trash-alt"></i></a>
                        @endif</h6>
                    <!-- Subtitle -->
                    <p class="card-text"><small><i class="far fa-calendar-alt"></i>
                            {{ date('d-m-Y', strtotime($userPhoto->photodate)) }}

                        </small></p>

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
                    <p class="card-text ">{{ $userPhoto->image_description }}</p>
                    <!-- Button -->
                    <ul>
                        <li>
                            <i class="fas fa-heart"></i>
                            <span> {{ $userPhoto->likes_sum }}</span>
                        </li>
                        <li>
                            <i class="fas fa-map-marker-alt"></i>
                            <span> {{ $loc->locality_name }}</span>
                        </li>
                        <li>
                            <i class="{{$cat->category_icon}}">
                            </i>
                            <span class="text-capitalize"> {{ $cat->category_name }}</span>
                        </li>
                    </ul>

                </div>

            </div>

        </div>
        @endforeach
        <!-- END Card -->
    </div>
</div>
<!--End of the User Portfolio -->
@endsection
