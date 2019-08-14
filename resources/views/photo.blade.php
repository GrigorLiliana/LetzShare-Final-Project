@extends('layout.master')

@section('title', 'Photos Gallery')

@section('content')

<div class="grid">
@foreach ($photos as $photo)
    <div class="grid__item" data-size="1280x857">
        <a href="img/original/6.jpg" class="img-wrap"><img src="{{ 	image_URL }}" alt="img06" />
            <div class="description description--grid">
                <h3>{{ image_title }}</h3>
                <p>{{ image_description }}</p>
                <div class="details">
                    <ul>
                        <li><i class="icon icon-camera"></i><span>Canon PowerShot S95</span></li>
                        <li><i class="icon icon-focal_length"></i><span>22.5mm</span></li>
                        <li><i class="icon icon-aperture"></i><span>&fnof;/5.6</span></li>
                        <li><i class="icon icon-exposure_time"></i><span>1/1000</span></li>
                        <li><i class="icon icon-iso"></i><span>80</span></li>
                    </ul>
                </div>
            </div>
        </a>
    </div>
@endforeach
</div>

@endsection

@endsection

