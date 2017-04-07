 @extends('layouts.admin')

 @section('content')

	<h1 class="page-header">Categories</h1>

	@if(Session::has('crudCategoryMsg'))

		<div class="alert alert-success">

			{{ session('crudCategoryMsg') }}

		</div>

	@endif

	@if(count($categories))

		<table class="table table-striped table-responsive">
		    <thead>
		      <tr>
		        <th>Id</th>
		        <th>Name</th>
		        <th>Posts</th>
		        <th>Edit</th>
		      </tr>
		    </thead>
		    <tbody>

		    @foreach($categories as $category)

				<tr>
					<td>{{$category->id}}</td>
					<td>{{$category->name}}</td>

					<td>
						<a href="{{route('admin.category.posts', $category->id)}}">
							<i class="fa fa-eye"></i>
						</a>
					</td>

					<td>
						<a href="{{route('admin.categories.edit', $category->id)}}">
							<i class="fa fa-edit"></i>
						</a>
					</td>
				</tr>

		    @endforeach

		    </tbody>
		</table>

		<div style="text-align: center;">
			{{$categories->render()}}
		</div>

	@else

		<div class="alert alert-danger">
			No categories to show
		</div>

	@endif

 @endsection