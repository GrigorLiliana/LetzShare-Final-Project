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
<!-- Edit Name -->
<form action="/useraccount" method="post" class="form-flex-profile edit-name">
    @csrf
    <h2>
        <!--User name-->
        @if($ownUser)Hello, @endif <span class="old-name older-name text-capitalize">{{$userPhotos[0]->name}}</span>

        @if($ownUser)<span class="old-name"> | </span><a href="#" id="editName">Edit Name</a>
        @endif
    </h2>
    <!--Form to edit name-->
    <div class="form-group flex-div div-edit-name hide">
        <input class="form-control profile-field" type="text" name="name" id="name" value="{{$userPhotos[0]->name}}"
            placeholder="Edit your name">
        <input type="number" class="hide user_id" name="user_id" value="{{Auth::user()->user_id}}">
        <input class="btn btn-primary mb-2 profile-field" type="submit" value="Save" name="save">
        <input class="btn btn-danger mb-2 profile-field cancel-edit" type="button" value="Cancel" name="cancel">
    </div>
</form>
<!--End edit name-->

<hr>
<!-- User details -->
<div class="card promoting-card card-user">
    <!-- Avatar -->
    <div class="profile-flex">
        <div class="edit-photo">
            <img src="{{URL::asset($userPhotos[0]->user_photo)}}" class="rounded-circle mr-3 user-profile img-thumbnail"
                height="150" width="150" alt="{{$userPhotos[0]->name}} photo">
            @if($ownUser)<p><a href="#">Edit photo</a></p>@endif
        </div>

        <!-- EDIT User description -->
        <div>
            <form action="/useraccount" method="post" class="form-flex-profile edit-description">
                @csrf
                <div>
                    <p><i class="fas fa-comment"></i>
                        <span class="old-description older-description text-capitalize">
                            <i>"@if($userPhotos[0]->user_description)
                                {{$userPhotos[0]->user_description}}@endif"</i>
                        </span>@if(!$ownUser)
                </div> @endif
                @if($ownUser)
                <span class="old-description">|</span>
                <a href="#" class="linkEditDescription">Edit Description</a>
                </p>
        </div>

        <div class="form-group flex-div div-edit-description hide">
            <textarea class="form-control" name="description" id="description" cols="50" rows="1"
                placeholder="Edit your description">{{$userPhotos[0]->user_description}}</textarea>
            <input type="number" class="hide user_id" name="user_id" value="{{Auth::user()->user_id}}">
            <input class="btn btn-primary mb-2 profile-field" type="submit" value="Save" name="save">
            <input class="btn btn-danger mb-2 profile-field cancel-edit" type="button" value="Cancel" name="cancel">
        </div>
        @endif
        <!--End if user is in your own profile-->

        </form>

        @if($userPhotos[0]->user_location)
        <p><i class="fas fa-map-marker-alt"></i> {{$userPhotos[0]->user_location}}
            @if($ownUser) | <a href="#">Edit Location</a></p>@endif
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
    <a href="#" class="add">
        Upload new photo <i class="fas fa-plus-circle"></i>
    </a>
    @endif
</h2>
<hr>

<!-- check if the user as photos -->
@if(count($userPhotos)>1)
<!--create a card for each photo if the user has photo -->
<div class="row">
    <div class="card-columns">

        @foreach ($userPhotos as $userPhoto)
        <div class="card promoting-card">

            <!-- Card content -->
            <div class="card-body d-flex flex-row">

                <!-- Content -->
                <div>

                    <!-- Title -->
                    <h6 class="card-title font-weight-bold mb-2">{{ $userPhoto->image_title }}
                        @if($ownUser)
                        <a href="#"><i class="far fa-edit text-success"></i></a>
                        <a href="#"><i class="far fa-trash-alt text-danger text-right"></i></a>
                        @endif</h6>
                    <!-- Subtitle -->
                    <p class="card-text"><small><i class="far fa-calendar-alt"></i>
                            {{ date('d-m-Y', strtotime($userPhoto->photodate)) }}

                        </small></p>

                </div>

            </div>

            <!-- Card image -->
            <div class="view overlay">
                <a href="{{ URL::asset($userPhoto->image_URL) }}">
                    <img class="card-img-top rounded-0" src="{{ URL::asset($userPhoto->image_URL) }}"
                        alt="{{ $userPhoto->image_title }}">
                    <div class="mask rgba-white-slight"></div>
                </a>
            </div>

            <!-- Card content -->
            <div class="card-body">

                <div class="collapse-content">

                    <!-- Text -->
                    <p class="card-text ">{{ str_limit($userPhoto->image_description, 90, '...') }}</p>
                    <!-- Button -->
                    <ul>
                        <li>
                            <i class="fas fa-heart"></i>
                            <span> {{ $userPhoto->likes_sum }}</span>
                        </li>
                        <li>
                            <i class="fas fa-map-marker-alt"></i>
                            <span> {{ $userPhoto->locality_name }}</span>
                        </li>
                        <li>
                            <i class="{{$userPhoto->category_icon}}">
                            </i>
                            <span class="text-capitalize"> {{ $userPhoto->category_name }}</span>
                        </li>
                    </ul>

                </div>

            </div>

        </div>
        @endforeach
        <!-- END Card -->

    </div>
</div>




@else
<div class="card promoting-card card-user">
    <div class="card-body d-flex flex-row">
        <p>This portfolio is empty for now. We're excited to see new photos from {{$userPhotos[0]->name}}!</p>

    </div>


</div>


@endif
<!--End of the User Portfolio -->
@endsection
