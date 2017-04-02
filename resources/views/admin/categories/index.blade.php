 @extends('layouts.admin')

 @section('content')

	<h1>Categories</h1>

	@if(Session::has('crudCategoryMsg'))

		<div class="alert alert-success">

			{{ session('crudCategoryMsg') }}

		</div>

	@endif


	<table class="table table-striped table-responsive">
	    <thead>
	      <tr>
	        <th>Id</th>
	        <th>Name</th>
	        <th>Edit</th>
	      </tr>
	    </thead>
	    <tbody>

	    @foreach($categories as $category)

			<tr>
				<td>{{$category->id}}</td>
				<td>{{$category->name}}</td>
				<td>
					<a href="{{route('admin.categories.edit', $category->id)}}">
						<i class="fa fa-edit"></i>
					</a>
				</td>
			</tr>

	    @endforeach

	    </tbody>
	  </table>


 @endsection