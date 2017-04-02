@extends('layouts.admin')

@section('content')

	<h1>Create Post</h1>


	@include('includes.formErrorsMessages')

	{!! Form::open(['method' => 'POST', 'action' => 'AdminPostsController@store', 'files' => true]) !!}

		<div class="form-group">

			{!! Form::label('title', 'Title:') !!}
			{!! Form::text('title', null, ['class' => 'form-control', 'placeholder' => 'Title']) !!}

		</div>

		<div class="form-group">

			{!! Form::label('body', 'Content:') !!}
			{!! Form::textarea('body', null, ['class' => 'form-control', 'placeholder' => 'Content']) !!}

		</div>

		<div class="form-group">

			{!! Form::label('category_id', 'Category:') !!}
			{!! Form::select('category_id', $categories, null, ['class' => 'form-control','placeholder' => 'Pick a category...']); !!}

		</div>

		<div class="form-group">
			
			{!! Form::label('photo_id', 'Post image:') !!}
			{!! Form::file('photo_id') !!}

		</div>


		<div class="form-group">

			{!! Form::submit('Create Post', ['class' => 'btn btn-primary', 'style' => 'margin-top: 10px;']); !!}

		</div>

		</div>


	{!! Form::close() !!}

@endsection