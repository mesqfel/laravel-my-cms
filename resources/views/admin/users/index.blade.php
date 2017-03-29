@extends('layouts.admin')

@section('content')

	<h1>Users</h1>

	<table class="table table-striped">
	    <thead>
	      <tr>
	        <th>Id</th>
	        <th>Photo</th>
	        <th>Name</th>
	        <th>Role</th>
	        <th>Email</th>
	        
	        <th>Status</th>
	        <th>Created at</th>
	        <th>Updated at</th>
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
				<td>{{$user->created_at->diffForHumans()}}</td>
				<td>{{$user->updated_at->diffForHumans()}}</td>
			</tr>

	    @endforeach

	    </tbody>
	  </table>

@endsection