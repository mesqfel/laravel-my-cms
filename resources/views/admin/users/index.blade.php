@extends('layouts.admin')

@section('content')

	<h1 class="page-header">Users</h1>

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
	        <th>Posts</th>
	        <th>Status</th>
	        <th>Edit</th>
	      </tr>
	    </thead>
	    <tbody>

	    @foreach($users as $user)

			<tr>
				<td>{{$user->id}}</td>
				<td>
					<div class="image-container">
					    @if($user->photo)
					    	<img height="50" src="{{ $user->photo->path }}">
						@else
							<img height="50" src="/images/profile-placeholder.jpg">
					    @endif
				    </div>
				</td>
				<td>{{$user->name}}</td>
				<td>{{$user->role->name}}</td>
				<td>{{$user->email}}</td>

				<td>
					<a href="{{route('admin.user.posts', $user->id)}}">
						<i class="fa fa-eye"></i>
					</a>
				</td>

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

	<div style="text-align: center;">
		{{$users->render()}}
	</div>

@endsection