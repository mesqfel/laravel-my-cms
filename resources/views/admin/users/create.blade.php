@extends('layouts.admin')

@section('content')

	<h1 class="page-header">Create User</h1>

@include('includes.formErrorsMessages')


{!! Form::open(['method' => 'POST', 'action' => 'AdminUsersController@store', 'files' => true]) !!}
	
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
		{!! Form::select('role_id', $roles, null, ['class' => 'form-control','placeholder' => 'Pick a role...']); !!}

	</div>

	<div class="form-group">

		{!! Form::label('is_active', 'Status:') !!}
		{!! Form::select('is_active', ['1' => 'Active', '0' => 'Not Active'], '1', ['class' => 'form-control']); !!}

	</div>

	<div class="form-group">

		{!! Form::label('password', 'Password:') !!}
		{!! Form::password('password', ['class' => 'form-control']); !!}

	</div>

	<div class="form-group">
		
		{!! Form::label('photo_id', 'Profile Photo:') !!}
		{!! Form::file('photo_id') !!}

	</div>


	<div class="form-group">

		{!! Form::submit('Create User', ['class' => 'btn btn-primary', 'style' => 'margin-top: 10px;']); !!}

	</div>

	</div>


{!! Form::close() !!}






@endsection