@extends('layouts.app')

@section('title', 'Photo Gallery')

@section('content')

<div class="filters form-group">
    <form action="" method="GET">
        @csrf
        <div class="form-group form-inline">
            <input class="form-control mr-sm-2 form-control-sm" type="search" placeholder="Search" aria-label="Search">
            <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
        </div>
        <div class="form-row">
            <div class="form-group col-md-2">
                <label for="photo-user">Photographers</label>
                <select class="form-control form-control-sm" name="users" id="users">
                    <option value="default">Select</option>
                    @foreach ($users as $user)
                    <option value="{{$user->user_id}}">{{$user->name}}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group col-md-2">
                <label for="photo-user">Location</label>
                <select class="form-control form-control-sm" name="locations" id="locations">
                    <option value="">Select</option>
                    @foreach ($locations as $location)
                    <option value="{{$location->locality_id}}">{{$location->locality_name}}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group col-md-2">
                <label for="photo-user">Category</label>
                <select class="form-control form-control-sm" name="category" id="category">
                    <option value="">Select</option>
                    @foreach ($categories as $category)
                    <option value="{{$category->category_id}}">{{$category->category_name}}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group col-md-2">
                <label for="photo-user">Likes</label>
                <select class="form-control form-control-sm" name="likes" id="likes_sum">
                    <option value="">Select</option>

                    <option value="likes_sum desc">desc</option>
                    <option value="likes_sum asc">asc</option>

                </select>
            </div>
            <div class="form-group col-sm-4">
                <label for="photo-user">Date</label>
                <select class="form-control form-control-sm">
                    <option>select</option>
                    <option>A-Z</option>
                </select>
            </div>
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>

<div class="row">
    <div class="card-columns">

        <!-- Card -->
        @foreach ($photos as $photo)
        <div class="card promoting-card">

            <!-- Card content -->
            <div class="card-body d-flex flex-row">

                <!-- Avatar -->
                <img src="{{URL::asset($photo->user_photo)}}" class="rounded-circle mr-3" height="50px" width="50px" alt="avatar">

                <!-- Content -->
                <div>

                    <!-- Title -->
                    <h6 class="card-title font-weight-bold mb-2 text-capitalize">{{ $photo->image_title }}</h6>
                    <!-- Subtitle -->
                    <p class="card-text"><small><i class="far fa-calendar-alt"></i>
                            {{date('d-m-Y', strtotime($photo->created_at)) }}
                        </small></p>

                </div>

            </div>

            <!-- Card image -->
            <div class="view overlay">
                <a href="{{ $photo->image_URL }}" data-fancybox="gallery" data-caption="<p>{{ $photo->image_description }}</p><hr><ul><li>
                            <i class='fas fa-map-marker-alt'></i>
                            <span>{{ $photo->locality_name }}</span>
                        </li><li><i class='fas fa-heart'></i>
                            <span>{{ $photo->likes_sum }}</span></li><li><i class='{{ $photo->category_icon }}'></i>
                            <span class='text-capitalize'>{{ $photo->category_name }}</span></li></ul>">
                    <img class="card-img-top rounded-0" src="{{ $photo->image_URL }}" alt="{{ $photo->image_title }}">
                    <div class="mask rgba-white-slight"></div>
                </a>
            </div>

            <!-- Card content -->
            <div class="card-body">

                <div class="collapse-content">

                    <!-- Text -->
                    <p class="card-text collapse text-capitalize" id="collapseContent">
                        {{ $photo->image_description }}</p>
                    <!-- Button -->
                    <ul>
                        <li>
                            <i class="fas fa-heart"></i>
                            <span>{{ $photo->likes_sum }}</span>
                        </li>
                        <li>
                            <i class="fas fa-map-marker-alt"></i>
                            <span>{{ $photo->locality_name }}</span>
                        </li>
                        <li>
                            <i class="{{ $photo->category_icon }}"></i>
                            <span class="text-capitalize">{{ $photo->category_name }}</span>
                        </li>
                    </ul>

                </div>

            </div>

        </div>
        @endforeach
        <!-- END Card -->

    </div>
</div>

@endsection