@extends('layouts.app')

@section('title', 'Photo Gallery')

@section('content')

<div class="container" id="galleryView">
    <div id="accordion">
        <div class="filters">
            <div class="card-header formfilters" id="headingOne">
                <h5 class="mb-0">
                    <button class="btn btn-link" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true"
                        aria-controls="collapseOne">
                        FILTERS
                    </button>
                </h5>
            </div>
    
            <div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#accordion">
                <form action="" method="POST" class="form-filters">
                    @csrf
                    <div class="form-row">
                        <div class="form-group col-md-3">
                            <label for="photo-user">Photographers</label>
                            <select class="form-control users form-control-sm" name="users" id="users">
                                <option value="default">Select</option>
                                @foreach ($users as $user)
                                <option value="{{$user->user_id}}">{{$user->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-md-3">
                            <label for="photo-user">Location</label>
                            <select class="form-control locations form-control-sm" name="locations" id="locations">
                                <option value="">Select</option>
                                @foreach ($locations as $location)
                                <option value="{{$location->locality_id}}">{{$location->locality_name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-md-2">
                            <label for="photo-user">Category</label>
                            <select class="form-control categories form-control-sm" name="categories" id="categories">
                                <option value="">Select</option>
                                @foreach ($categories as $category)
                                <option value="{{$category->category_id}}">{{$category->category_name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-sm-2">
                            <label for="photo-user">Date From</label>
                            <input type="date" class="form-control form-control-sm" name="firstdate" id="firstdate">
                        </div>
                        <div class="form-group col-sm-2">
                            <label for="photo-user">Date To</label>
                            <input type="date" class="form-control form-control-sm" id="lastdate" name="lastdate">
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    </div>
    
    <div class="row gallery">
        <div class="card-columns">
    
            <!-- Card -->
            @foreach ($photos as $photo)
            <div class="card promoting-card">
    
                <!-- Card content -->
                <div class="card-body d-flex flex-row">
    
                    <!-- Avatar -->
                    <a href="/userprofile/{{$photo->user_id}}">
                        <img src="{{URL::asset($photo->user_photo)}}" class="rounded-circle mr-3" height="50" width="50"
                            alt="avatar">
                    </a>
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
                        <div class="formHide">
                            <a class="readMore" data-toggle="collapse" href="#collapse-{{ $photo->photo_id }}" role="button"
                                aria-expanded="false" aria-controls="collapseExample">
                                <i class="fas fa-angle-down"></i>
                            </a>
                        </div>
                        <p class="card-text collapse text-capitalize" id="collapse-{{ $photo->photo_id }}">
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
    
    <div class="pagination">
        {{ $photos->links() }}
    </div>
</div>

@endsection
