@extends('layouts.admin')

@section('content')


	<h1>Edit Category</h1>


	@include('includes.formErrorsMessages')


	{!! Form::model($category, ['method' => 'PATCH', 'action' => ['AdminCategoriesController@update', $category->id]]) !!}
		
		<div class="form-group">

			{!! Form::label('name', 'Name:') !!}
			{!! Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'Name']) !!}

		</div>

		<div class="form-group">

			{!! Form::submit('Save', ['class' => 'btn btn-primary pull-left', 'style' => 'margin-right: 5px;']); !!}

		</div>

	{!! Form::close() !!}

	{!! Form::open(['method' => 'DELETE', 'action' => ['AdminCategoriesController@destroy', $category->id]  ]) !!}

		<div class="form-group">

			{!! Form::submit('Delete', ['class' => 'btn btn-danger']); !!}

		</div>

	{!! Form::close() !!}


@endsection