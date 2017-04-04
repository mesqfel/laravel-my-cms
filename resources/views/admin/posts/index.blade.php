 @extends('layouts.admin')

 @section('content')

	<h1>Posts</h1>

	@if(Session::has('crudPostMsg'))

		<div class="alert alert-success">

			{{ session('crudPostMsg') }}

		</div>

	@endif

	@if(count($posts))
		<table class="table table-striped table-responsive">
		    <thead>
		      <tr>
		        <th>Id</th>
		        <th>Image</th>
		        <th>Author</th>
		        <th>Category</th>
		        <th>Title</th>
		        <th>Body</th>
		        <th>Edit</th>
		        <th>View</th>
		        <th>Comments</th>
		      </tr>
		    </thead>
		    <tbody>

		    @foreach($posts as $post)

				<tr>
					<td>{{$post->id}}</td>
					<td>
					    @if($post->photo)						    
						    <div class="image-container">
						    	<img height="50" src="{{ $post->photo->path }}">
						    </div>
					    @endif
					</td>
					<td>{{$post->user->name}}</td>
					<td>{{$post->category->name}}</td>
					<td>{{$post->title}}</td>
					<td>{{str_limit($post->body, 100)}}</td> 
					
					<td>
						<a href="{{route('admin.posts.edit', $post->id)}}">
							<i class="fa fa-edit"></i>
						</a>
					</td>

					<td>
						<a target = "_blank" href="{{route('home.post', $post->id)}}">
							<i class="fa fa-eye"></i>
						</a>
					</td>

					<td>
						<a href="{{route('admin.posts.comments', $post->id)}}">
							<i class="fa fa-comments-o
	"></i>
						</a>
					</td>
				</tr>

		    @endforeach

		    </tbody>
		  </table>

	@else

		<div class="alert alert-danger">
			No posts to show
		</div>

	@endif


 @endsection