@extends('layouts.app')

@section('title', 'Admin Dashboard | LetzShare')

@section('content')

<h1>Admin Dashborad</h1>
<hr>
<h3 class="display-5 mt-3">Photos from user</h3>
<div class="table-responsive">
    <table class="table table-sm table-striped table-bordered table-hover">
        <thead class="thead-dark">
          <tr>
            <th scope="col">photo_id <i class="fa fa-fw fa-sort"></i></th>
            <th scope="col">image_URL <i class="fa fa-fw fa-sort"></i></th>
            <th scope="col">image_title <i class="fa fa-fw fa-sort"></i></th>
            <th scope="col">image_description</i></th>
          </tr>
        </thead>
        <tbody>
          @foreach ($photos as $photo)
            <tr>
            <td>{{ $photo->photo_id }}</td>
              <td>{{ $photo->image_URL }}</td>
              <td>{{ $photo->image_title }}</td>
              <td>{{ str_limit($photo->image_description, 90, '...') }}</td>
            </tr>
          @endforeach
        </tbody>
      </table>
</div>

@endsection
