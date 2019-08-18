@extends('layouts.app')

@section('title', 'Photo Gallery')

@section('content')

<div class="row">
@foreach ($photos as $photo)
    <div class="col-sm-4">

        <div class="card mb-3">
            <a href="{{ $photo->image_URL }}">
                <img src="{{ $photo->image_URL }}" class="card-img-top" alt="{{ $photo->image_title }}">
                <div class="card-body">
                    <h5 class="card-title">{{ $photo->image_title }}</h5>
                    <p class="card-text">{{ $photo->image_description }}</p>
                    <p class="card-text">Author: <em>&mdash; {{ $photo->name }}</em></p>
                    <ul>
                        <li>
                            <i class="fas fa-heart"></i>
                            <span>{{ $photo->likes_sum }}</span></li>
                        <li>
                            <i class="fas fa-map-marker-alt"></i>
                            <span>{{ $photo->locality_id }}</span></li>
                        <li>
                            @if($photo->category_id === 1)
                            <i class="fas fa-landmark"></i>
                            <span>Culture</span>
                            @endif

                            @if($photo->category_id === 2)
                            <i class="fas fa-users"></i>
                            <span>Events</span>
                            @endif

                            @if($photo->category_id === 4)
                            <i class="fas fa-monument"></i>
                            <span>Monuments</span>
                            @endif

                            @if($photo->category_id === 5)
                            <i class="fas fa-tree"></i>
                            <span>Nature</span>
                            @endif

                            @if($photo->category_id === 6)
                            <i class="fas fa-glass-cheers"></i>
                            <span>Night Life</span>
                            @endif
                        <li>
                    </ul>
                    <p class="card-text"><small class="text-muted">{{ $photo->date }}</small></p>
                </div>
            </a>
        </div>

    </div>
    @endforeach
</div>

<!-- Card -->
<div class="card promoting-card">

  <!-- Card content -->
  <div class="card-body d-flex flex-row">

    <!-- Avatar -->
    <img src="https://mdbootstrap.com/img/Photos/Avatars/avatar-8.jpg" class="rounded-circle mr-3" height="50px" width="50px" alt="avatar">

    <!-- Content -->
    <div>

      <!-- Title -->
      <h4 class="card-title font-weight-bold mb-2">{{ $photo->image_title }}</h4>
      <!-- Subtitle -->
      <p class="card-text"><i class="far fa-clock pr-2"></i>{{ $photo->date }}</p>

    </div>

  </div>


  @foreach ($photos as $photo)
  <!-- Card image -->
  <div class="view overlay">
    <img class="card-img-top rounded-0" src="{{ $photo->image_URL }}" alt="Card image cap">
    <a href="#!">
      <div class="mask rgba-white-slight"></div>
    </a>
  </div>

  <!-- Card content -->
  <div class="card-body">

    <div class="collapse-content">

      <!-- Text -->
      <p class="card-text collapse" id="collapseContent">{{ $photo->image_description }}</p>
      <!-- Button -->
      <ul>
        <li>
            <i class="fas fa-heart"></i>
            <span>{{ $photo->likes_sum }}</span></li>
        <li>
            <i class="fas fa-map-marker-alt"></i>
            <span>{{ $photo->locality_id }}</span></li>
        <li>
            @if($photo->category_id === 1)
            <i class="fas fa-landmark"></i>
            <span>Culture</span>
            @endif

            @if($photo->category_id === 2)
            <i class="fas fa-users"></i>
            <span>Events</span>
            @endif

            @if($photo->category_id === 4)
            <i class="fas fa-monument"></i>
            <span>Monuments</span>
            @endif

            @if($photo->category_id === 5)
            <i class="fas fa-tree"></i>
            <span>Nature</span>
            @endif

            @if($photo->category_id === 6)
            <i class="fas fa-glass-cheers"></i>
            <span>Night Life</span>
            @endif
        <li>
    </ul>

  </div>

  </div>

</div>
<!-- Card -->


@endsection
