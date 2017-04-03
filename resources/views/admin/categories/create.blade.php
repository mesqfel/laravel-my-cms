@extends('layouts.admin')

@section('content')

	<h1>Create Category</h1>


	@include('includes.formErrorsMessages')

	{!! Form::open(['method' => 'POST', 'action' => 'AdminCategoriesController@store']) !!}

		<div class="form-group">

			{!! Form::label('name', 'Name:') !!}
			{!! Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'Name']) !!}

		</div>

		<div class="form-group">

			{!! Form::submit('Create Category', ['class' => 'btn btn-primary', 'style' => 'margin-top: 10px;']); !!}

		</div>

	{!! Form::close() !!}

@endsection