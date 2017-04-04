 @extends('layouts.admin')

 @section('content')

	<h1>Media</h1>

	@if(Session::has('crudMediaMsg'))

		<div class="alert alert-success">

			{{ session('crudMediaMsg') }}

		</div>

	@endif

	@if(count($photos))

		<table class="table table-striped table-responsive">
		    <thead>
		      <tr>
		        <th>Id</th>
		        <th>Image</th>
		        <th>Name</th>
		        <th></th>
		      </tr>
		    </thead>
		    <tbody>

		    @foreach($photos as $photo)

				<tr>
					<td>{{$photo->id}}</td>
					<td>
					    <div class="image-container">
					    	<img height="50" src="{{$photo->path}}">
					    </div>
					</td>
					<td>{{str_replace('/images/',  '',$photo->path)}}</td>
					<td>

						{!! Form::open(['method' => 'DELETE', 'action' => ['AdminMediaController@destroy', $photo->id]  ]) !!}

							<div class="form-group">

								{!! Form::submit('Delete', ['class' => 'btn btn-danger']); !!}

							</div>

						{!! Form::close() !!}

					</td>

				</tr>

		    @endforeach

		    </tbody>
		  </table>

	@else

		<div class="alert alert-danger">
			No images to show
		</div>

	@endif

 @endsection