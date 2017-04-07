@extends('layouts.admin')

@section('content')

	<h1 class="page-header">{{$category}} Posts</h1>

@if(Session::has('crudPostMsg'))

	<div class="alert alert-success">

		{{ session('crudPostMsg') }}

	</div>

@endif

@if(count($posts))

	<form action="/admin/posts/multidestroy" method="post">

		{{ csrf_field() }}
		
		<table class="table table-striped table-responsive">
		    <thead>
				<tr>
					<th>
						<input class="posts-unselected" type="checkbox" id="allPostsCheckbox">
					</th>

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

					<td>
						<input type="checkbox" class="checkbox-posts" name="postsCheckboxArray[]" value="{{$post->id}}">
					</td>

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
					<td>{{str_limit(strip_tags($post->body), 100)}}</td> 
					
					<td>
						<a href="{{route('admin.posts.edit', $post->id)}}">
							<i class="fa fa-edit"></i>
						</a>
					</td>

					<td>
						<a target = "_blank" href="{{route('home.post', $post->slug)}}">
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

		<div class="form-group">
			<input id="btnMultiDelete" type="submit" class="btn btn-xs btn-danger" value="Delete" style="display: none;">
		</div>

	  </form>

	<div style="text-align: center;">
		{{$posts->render()}}
	</div>

@else

	<div class="alert alert-danger">
		No posts to show for this category
	</div>

@endif

@endsection


@section('footer')

	<script type="text/javascript">


	    $(document).ready(function(){

	        $(document).on('click', '#allPostsCheckbox', function(){

	        	if($(this).hasClass('posts-unselected'))
	        		$('.checkbox-posts').prop('checked', true);
	        	else
	        		$('.checkbox-posts').prop('checked', false);

	        	$(this).toggleClass('posts-unselected');
	        });

	        $(document).on('click', '#allPostsCheckbox, .checkbox-posts', function(){

	        	if($('input[name="postsCheckboxArray[]"]:checked').length > 0){
	        		$('#btnMultiDelete').show();
	        	}
	        	else{
		        	$('#btnMultiDelete').hide();
	        	}

	        });

	    });

	</script>

@endsection