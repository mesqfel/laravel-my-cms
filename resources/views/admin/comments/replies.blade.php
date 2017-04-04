 @extends('layouts.admin')

 @section('content')

	<h1>Replies for Comment id {{$comment->id}} </h1>

	@if(Session::has('crudCommentReplyMsg'))

		<div class="alert alert-success">

			{{ session('crudCommentReplyMsg') }}

		</div>

	@endif

	@if(count($comment->replies))

		<table class="table table-striped table-responsive">
		    <thead>
		      <tr>
		        <th>Id</th>
		        <th>Post</th>
		        <th>Author</th>
		        <th>Author Photo</th>
		        <th>Author Email</th>
		        <th>Reply</th>
		        <th>Moderate</th>
		        <th></th>
		      </tr>
		    </thead>
		    <tbody>

		    @foreach($comment->replies as $reply)

				<tr>
					<td>{{$reply->id}}</td>
					<td>
						<a target="_blank" href="{{route('home.post', $comment->post->slug)}}">
							{{$comment->post->title}}	
						</a>
					</td>
					<td>{{$reply->author}}</td>

					<td>
						<div class="image-container">
						    @if($reply->photo)
						    	<img height="50" src="{{ $reply->photo }}">
					    	@else
						    	<img height="50" src="/images/profile-placeholder.jpg">
						    @endif
					    </div>
					</td>

					<td>{{$reply->email}}</td>
					<td>{{$reply->body}}</td>

					{{-- Moderate --}}
					<td>

						{!! Form::open(['method' => 'PATCH', 'action' => ['CommentRepliesController@moderate', $reply->id]]) !!}

							{!! Form::hidden('is_active', $reply->is_active) !!}

							<div class="form-group">

								@if(!$reply->is_active)
								
									{!! Form::submit('Approve', ['class' => 'btn btn-success']); !!}

								@else

									{!! Form::submit('Reject', ['class' => 'btn btn-danger']); !!}
								    
								@endif

							</div>

						{!! Form::close() !!}

					</td>

					{{-- Delete --}}
					<td>

						{!! Form::open(['method' => 'DELETE', 'action' => ['CommentRepliesController@destroy', $reply->id]  ]) !!}

							<div class="form-group">

								{!! Form::submit('Delete', ['class' => 'btn btn-danger']); !!}

							</div>

						{!! Form::close() !!}

					</td>

				</tr>

		    @endforeach

		    </tbody>
		</table>

		<div style="text-align: center;">
			{{$comment->replies->render()}}
		</div>


	@else

		<div class="alert alert-danger">
			No replies to show
		</div>

	@endif

 @endsection