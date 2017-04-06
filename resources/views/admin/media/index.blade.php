 @extends('layouts.admin')

 @section('content')

	<h1 class="page-header">Images</h1>

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