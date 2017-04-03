@extends('layouts.admin')

@section('content')

	<h1>Users</h1>

	@if(Session::has('crudUserMsg'))

		<div class="alert alert-success">

			{{ session('crudUserMsg') }}

		</div>

	@endif

	<table class="table table-striped table-responsive">
	    <thead>
	      <tr>
	        <th>Id</th>
	        <th>Photo</th>
	        <th>Name</th>
	        <th>Role</th>
	        <th>Email</th>
	        <th>Status</th>
	        <th>Edit</th>
	      </tr>
	    </thead>
	    <tbody>

	    @foreach($users as $user)

			<tr>
				<td>{{$user->id}}</td>
				<td>
				    @if($user->photo)						    
					    <div class="image-container">
					    	<img height="50" src="{{ $user->photo->path }}">
					    </div>
				    @endif
				</td>
				<td>{{$user->name}}</td>
				<td>{{$user->role->name}}</td>
				<td>{{$user->email}}</td>
				<td>{{$user->is_active ? 'Active' : 'Not Active'}}</td>
				<td>
					<a href="{{route('admin.users.edit', $user->id)}}">
						<i class="fa fa-edit"></i>
					</a>
				</td>

			</tr>

	    @endforeach

	    </tbody>
	  </table>

@endsection