@extends('layouts.admin')

@section('content')

	<h1>Users</h1>

	<table class="table table-striped">
	    <thead>
	      <tr>
	        <th>Id</th>
	        <th>Name</th>
	        <th>Role</th>
	        <th>Email</th>
	      </tr>
	    </thead>
	    <tbody>

	    @foreach($users as $user)

			<tr>
				<td>{{$user->id}}</td>
				<td>{{$user->name}}</td>
				<td>{{$user->role->name}}</td>
				<td>{{$user->email}}</td>
			</tr>

	    @endforeach

	    </tbody>
	  </table>

@endsection