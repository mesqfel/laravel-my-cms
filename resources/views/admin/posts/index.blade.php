 @extends('layouts.admin')

 @section('content')

	<h1>Posts</h1>

	@if(Session::has('crudPostMsg'))

		<div class="alert alert-success">

			{{ session('crudPostMsg') }}

		</div>

	@endif


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
	      </tr>
	    </thead>
	    <tbody>

	    @foreach($posts as $post)

			<tr>
				<td>{{$post->id}}</td>
				<td>
				    @if($post->photo)						    
					    <div class="image-container">
					    	<img height="50" src="/images/posts/{{ $post->photo->path }}">
					    </div>
				    @endif
				</td>
				<td>{{$post->user->name}}</td>
				<td>{{$post->category_id}}</td>
				<td>{{$post->title}}</td>
				<td>{{$post->body}}</td>
				<td>
					<a href="{{route('admin.posts.edit', $post->id)}}">
						<i class="fa fa-edit"></i>
					</a>
				</td>
			</tr>

	    @endforeach

	    </tbody>
	  </table>


 @endsection