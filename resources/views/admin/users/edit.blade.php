@extends('layouts.admin')

@section('content')


	<h1>Edit User</h1>


	@include('includes.formErrorsMessages')


	{!! Form::model($user, ['method' => 'PATCH', 'action' => ['AdminUsersController@update', $user->id], 'files' => true]) !!}
		
		<div class="form-group">

			{!! Form::label('name', 'Name:') !!}
			{!! Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'Name']) !!}

		</div>

		<div class="form-group">

			{!! Form::label('email', 'Email:') !!}
			{!! Form::email('email', null, ['class' => 'form-control', 'placeholder' => 'Email']) !!}

		</div>

		<div class="form-group">

			{!! Form::label('role_id', 'Role:') !!}
			{!! Form::select('role_id', $roles, null, ['class' => 'form-control']); !!}

		</div>

		<div class="form-group">

			{!! Form::label('is_active', 'Status:') !!}
			{!! Form::select('is_active', ['1' => 'Active', '0' => 'Not Active'], null, ['class' => 'form-control']); !!}

		</div>

		<div class="form-group">
			
			{!! Form::label('photo_id', 'Profile Photo:') !!}

			    @if($user->photo)						    
				    <div class="image-container">
				    	<img height="50" src="{{ $user->photo->path }}" style="margin-bottom: 7px;">
				    </div>
			    @endif

			{!! Form::file('photo_id') !!}

		</div>


		<div class="form-group">

			{!! Form::submit('Save', ['class' => 'btn btn-primary pull-left', 'style' => 'margin-right: 5px;']); !!}

		</div>

	{!! Form::close() !!}

	{!! Form::open(['method' => 'DELETE', 'action' => ['AdminUsersController@destroy', $user->id]  ]) !!}

		<div class="form-group">

			{!! Form::submit('Delete', ['class' => 'btn btn-danger']); !!}

		</div>

	{!! Form::close() !!}


@endsection