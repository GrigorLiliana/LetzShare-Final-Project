@extends('layouts.app')

@section('title', 'Admin Dashboard | LetzShare')

@section('content')

<h1>Admin Dashborad</h1>
<hr>
<h3 class="display-5 mt-3">List of Users</h3>
<div class="table-responsive">
    <table class="table table-sm table-striped table-bordered table-hover">
        <thead class="thead-dark">
          <tr>
            <th scope="col">User ID</th>
            <th scope="col">Name</th>
            <th scope="col">E-Mail</th>
            <th scope="col">User Type</th>
          </tr>
        </thead>
        <tbody>
    @foreach ($users as $user)
          <tr>
          <th scope="row">{{ $user->user_id }}</th>
            <td>{{ $user->name }}</td>
            <td>{{ $user->email }}</td>
            <td>{{ $user->user_type }}</td>
          </tr>
          @endforeach
        </tbody>
      </table>
</div>

@endsection
