@extends('layouts.app')

@section('title', 'About us | LetzShare')

@section('content')



<main role="main">

    <div class="jumbotron">
        <h1 class="display-5">LetzShare - The beauty of Luxembourg</h1>
        <p class="lead">LetzShare is a website for users to upload and share photographs of Luxembourg. These can be rated and commented upon by other users and the site will keep track of the most liked photos. Luxembourg is a small country nestling between France, Germany and Belgium and is not so well known outside the region.</p>

        <p class="lead">By creating a platform to showcase attractive images of the Grand Duchy we hope to play a role in elevating its profile. Rich in history with many monuments and historic buildings this small country is also favoured by many attractive natural landscapes and beauty spots.</p>
        
        <p class="lead">As well as this Luxembourg has its own unique culture and hugely diverse and multicultural population with a vibrant culture and nightlife reflecting this. Letzshare will be the platform which allows users to share images of all these aspects of Luxembourg.</p>
    </div>
  
    <div class=" card text-center">
      
        <div class="card-header">
            <h1>The LetzShare's Team</h1>
        </div>

        <div class="card-body">
            <div class="row">
                <div class="col-md-6 col-lg-6 mb-5">
                    {{-- <svg class="bd-placeholder-img rounded-circle" width="140" height="140" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="xMidYMid slice" focusable="false" role="img" aria-label="Placeholder: 140x140"><title>Placeholder</title><rect width="100%" height="100%" fill="#777"/><text x="50%" y="50%" fill="#777" dy=".3em">140x140</text></svg> --}}
                <div class="">
                    <img src="{{ asset('uploads/avatars-admin/liliana.jpg')}}" alt="" class="rounded-circle mb-3 user-profile" width="150px" height="150px">
                </div>
                    <h2>Liliana</h2>
                    <p>Donec sed odio dui. Etiam porta sem malesuada magna mollis euismod.</p>
                <p><a class="btn btn-secondary" href="{{ url('userprofile/10') }}" role="button">View profile &raquo;</a></p>
                </div>
                
                <div class="col-md-6 col-lg-6 mb-5">
                    <div class="">
                        <img src="{{ asset('uploads/avatars-admin/stuart.jpg')}}" alt="" class="rounded-circle mb-3 user-profile" width="150px" height="150px">
                    </div>
                    <h2>Stuart</h2>
                    <p>Donec sed odio dui. Etiam porta sem malesuada magna mollis euismod.</p>
                    <p><a class="btn btn-secondary" href="{{ url('userprofile/9') }}" role="button">View profile &raquo;</a></p>
                </div>

                <div class="col-md-6 col-lg-6 mb-5">
                    <div class="">
                        <img src="{{ asset('uploads/avatars-admin/ricardo.jpg')}}" alt="" class="rounded-circle mb-3 user-profile" width="150px" height="150px">
                    </div>
                    <h2>Ricardo</h2>
                    <p>Donec sed odio dui. Etiam porta sem malesuada magna mollis euismod.</p>
                    <p><a class="btn btn-secondary" href="{{ url('userprofile/21') }}" role="button">View profile &raquo;</a></p>
                </div>

                <div class="col-md-6 col-lg-6 mb-5">
                    <div class="">
                        <img src="{{ asset('uploads/avatars-admin/michel.jpg')}}" alt="" class="rounded-circle mb-3 user-profile" width="150px" height="150px">
                    </div>
                    <h2>Michel</h2>
                    <p>Donec sed odio dui. Etiam porta sem malesuada magna mollis euismod.</p>
                    <p><a class="btn btn-secondary" href="{{ url('userprofile/1') }}" role="button">View profile &raquo;</a></p>
                </div>
            </div><!-- /.row -->
        </div><!-- /.card-body -->
    </div><!-- /.card -->

</main>

@endsection
