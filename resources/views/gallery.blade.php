@extends('layouts.app')

@section('title', 'Photo Gallery')

@section('content')

<div class="gallery">
    @foreach ($photos as $photo)
    <a href="{{ $photo->image_URL }}"  data-toggle="lightbox">
        <img src="{{ $photo->image_URL }}" class="img-fluid" alt="{{ $photo->image_title }}">
    </a>
    @endforeach
</div>


</div>
<script>
    $(document).on('click', '[data-toggle="lightbox"]', function(event) {
        event.preventDefault();
        $(this).ekkoLightbox();
    });
</script>
@endsection