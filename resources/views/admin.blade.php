@extends('layouts.app')

@section('title', 'Admin Dashboard | LetzShare')

@section('content')
<h1>Admin Dashborad</h1>
<hr>
<div id="list-of-users">
  <h3 class="display-5 mt-3">List of Users</h3>
  <div class="table-responsive">
      <table class="table table-striped table-bordered table-hover">
          <thead class="thead-dark">
            <tr>
              <th scope="col">User ID</th>
              <th scope="col">User</th>
              <th scope="col">User photos</th>
              <th scope="col">E-Mail</th>
              <th scope="col">User Type</th>
              <th scope="col">Action</i></th>
            </tr>
          </thead>
          <tbody>
      @foreach ($users as $user)
      @php
          $userPhotos = App\Photo::where('user_id', '=', $user->user_id)->count();
      @endphp
            <tr>
              <td>{{ $user->user_id }}</td>
              <td><a href="userprofile/{{ $user->user_id }}">{{ ucfirst($user->name) }}</a></td>
              <td>{{ $userPhotos }}</td>
              <td>{{ $user->email }}</td>
              <td>{{ $user->user_type }}</td>
              <td>
                  <a href="userprofile/{{ $user->user_id }}" title="User details"><i class="fas fa-eye"></i></a>&nbsp;
                @if ( $user->user_type != 'admin' ) 
                  <a href="/admin/showUser/{{ $user->user_id }}" title="Delete User & files"><i class="fas fa-minus-circle"></i></a>
                @else
                <span title="You can't delete an admin"><i class="fas fa-minus-circle fa-disabled"></i></span>
                @endif
              </td>
            </tr>
            @endforeach
          </tbody>
        </table>
  </div>
</div>
<hr>
<div id="list-of-photos">
  <h3 class="display-5 mt-3">List of reported Photos</h3>
  <div class="table-responsive">
      <table class="table table-striped table-bordered table-hover">
          <thead class="thead-dark">
            <tr>
              <th scope="col">Photo ID</th>
              <th scope="col">Posted by</th>
              <th scope="col">Image Title</th>
              <th scope="col">Location</th>
              <th scope="col">Category</th>
              <th scope="col">Action</i></th>
            </tr>
          </thead>
          <tbody>
      @foreach ($reportedPhotos as $reportedPhoto)
            <tr>
              <td>{{ $reportedPhoto->photo_id }}</td>
              <td>{{ $reportedPhoto->user }}</td>
              <td>{{ $reportedPhoto->image_title }}</td>
              <td>{{ $reportedPhoto->locality }}</td>
              <td>{{ ucfirst($reportedPhoto->category) }}</td>
              <td>
                  <a href="userprofile/{{ $user->user_id }}" title="Edit User details"><i class="fas fa-eye"></i></a>&nbsp;
                  <a href="/admin/showPhoto/{{ $user->user_id }}" title="Delete User & files"><i class="fas fa-minus-circle"></i></a>
              </td>
            </tr>
            @endforeach
          </tbody>
        </table>
  </div>
</div>

@endsection
