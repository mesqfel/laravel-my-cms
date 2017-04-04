 @extends('layouts.admin')

 @section('content')

	<h1>Comments for Post Id {{$post->id}}</h1>

	@if(Session::has('crudCommentMsg'))

		<div class="alert alert-success">

			{{ session('crudCommentMsg') }}

		</div>

	@endif

	@if(count($post->comments))
		<table class="table table-striped table-responsive">
		    <thead>
		      <tr>
		        <th>Id</th>
		        <th>Author</th>
		        <th>Author Photo</th>
		        <th>Author Email</th>
		        <th>Comment</th>
		        <th>Moderate</th>
		        <th></th>
		      </tr>
		    </thead>
		    <tbody>

		    @foreach($post->comments as $comment)

				<tr>
					<td>{{$comment->id}}</td>
					<td>{{$comment->author}}</td>

					<td>
						<div class="image-container">
						    @if($comment->photo)
						    	<img height="50" src="{{ $comment->photo }}">
					    	@else
						    	<img height="50" src="/images/profile-placeholder.jpg">
						    @endif
					    </div>
					</td>

					<td>{{$comment->email}}</td>
					<td>{{$comment->body}}</td>

					{{-- Moderate --}}
					<td>

						{!! Form::open(['method' => 'PATCH', 'action' => ['PostCommentsController@moderate', $comment->id]]) !!}

							{!! Form::hidden('is_active', $comment->is_active) !!}

							<div class="form-group">

								@if(!$comment->is_active)
								
									{!! Form::submit('Approve', ['class' => 'btn btn-success']); !!}

								@else

									{!! Form::submit('Reject', ['class' => 'btn btn-danger']); !!}
								    
								@endif

							</div>

						{!! Form::close() !!}

					</td>

					{{-- Delete --}}
					<td>

						{!! Form::open(['method' => 'DELETE', 'action' => ['PostCommentsController@destroy', $comment->id]  ]) !!}

							<div class="form-group">

								{!! Form::submit('Delete', ['class' => 'btn btn-danger']); !!}

							</div>

						{!! Form::close() !!}

					</td>


					{{-- <td>{{$comment->is_active ? 'Active' : 'Not active'}}</td> --}}
				</tr>

		    @endforeach

		    </tbody>
		  </table>
	@else

		<div class="alert alert-danger">
			No comments to show
		</div>

	@endif

 @endsection