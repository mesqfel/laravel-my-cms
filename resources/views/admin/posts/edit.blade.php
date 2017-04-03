 @extends('layouts.admin')

 @section('content')

	<h1>Edit Post</h1>

	@include('includes.formErrorsMessages')


	{!! Form::model($post, ['method' => 'PATCH', 'action' => ['AdminPostsController@update', $post->id], 'files' => true]) !!}

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
		{!! Form::select('category_id', $categories, null, ['class' => 'form-control']); !!}

	</div>

	<div class="form-group">
		
		{!! Form::label('photo_id', 'Post image:') !!}

		    @if($post->photo)
			    <div class="image-container">
			    	<img height="50" src="{{ $post->photo->path }}" style="margin-bottom: 7px;">
			    </div>
		    @endif

		{!! Form::file('photo_id') !!}

	</div>


	<div class="form-group">

		{!! Form::submit('Save', ['class' => 'btn btn-primary pull-left', 'style' => 'margin-right: 5px;']); !!}

	</div>

	{!! Form::close() !!}

	{!! Form::open(['method' => 'DELETE', 'action' => ['AdminPostsController@destroy', $post->id]  ]) !!}

		<div class="form-group">

			{!! Form::submit('Delete', ['class' => 'btn btn-danger']); !!}

		</div>

	{!! Form::close() !!}

 @endsection