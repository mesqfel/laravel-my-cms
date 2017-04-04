@extends('layouts.blog-post')

@section('content')

    
    <!-- Title -->
    <h1>{{$post->title}}</h1>

    <!-- Author -->
    <p class="lead">
        by <a href="#">{{$post->user->name}}</a>
    </p>

    <hr>

    <!-- Date/Time -->
    {{-- <p><span class="glyphicon glyphicon-time"></span> Posted on August 24, 2013 at 9:00 PM</p> --}}
    <p><span class="glyphicon glyphicon-time"></span> Posted on {{$post->created_at->format('F j, Y \a\t g:ia')}}</p>

    

    <hr>

    <!-- Preview Image -->
    {{-- <img class="img-responsive" src="http://placehold.it/900x300" alt=""> --}}
    <img class="img-responsive" src="{{$post->photo->path}}" alt="">
    

    <hr>

    <p>{{$post->body}}</p>

    <hr>

    <!-- Blog Comments -->

    <!-- Comments Form -->
    <div class="well">
        <h4>Leave a Comment:</h4>


        @if(count($errors))

            @foreach($errors->all() as $error)

                <p style="color: red;">
                    <strong>{{$error}}</strong>
                </p>

            @endforeach

        @endif

        @if(Session::has('crudCommentMsg'))

            <div class="alert alert-success">

                {{ session('crudCommentMsg') }}

            </div>

        @endif

        {!! Form::open(['method' => 'POST', 'action' => 'PostCommentsController@store']) !!}

            {!! Form::hidden('post_id', $post->id) !!}

            <div class="form-group">

                {!! Form::textarea('body', null, ['class' => 'form-control', 'rows' => 3]) !!}

            </div>

            <div class="form-group">

                {!! Form::submit('Submit', ['class' => 'btn btn-primary']); !!}

            </div>

        {!! Form::close() !!}

    </div>

    <hr>

    <!-- Posted Comments -->

    <!-- Comment -->

    <div>

        @foreach($post->comments as $_comment)

            @if($_comment->is_active)

                <div class="media">
                    <a class="pull-left" href="#">
                        
                        @if($_comment->photo)
                            <img height="50" class="media-object" src="{{$_comment->photo}}" alt="">
                        @else
                            <img height="50" class="media-object" src="/images/profile-placeholder.jpg" alt="">
                        @endif

                    </a>
                    <div class="media-body">
                        <h4 class="media-heading">

                            {{$_comment->author}}

                            <small>{{$_comment->created_at->format('F j, Y \a\t g:ia')}}</small>
                        </h4>

                        {{$_comment->body}}

                    </div>
                </div>

            @endif

        @endforeach

    </div>

    <!-- Comment -->
{{--     <div class="media">
        <a class="pull-left" href="#">
            <img class="media-object" src="http://placehold.it/64x64" alt="">
        </a>
        <div class="media-body">
            <h4 class="media-heading">Start Bootstrap
                <small>August 25, 2014 at 9:30 PM</small>
            </h4>
            Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin commodo. Cras purus odio, vestibulum in vulputate at, tempus viverra turpis. Fusce condimentum nunc ac nisi vulputate fringilla. Donec lacinia congue felis in faucibus.
            
            Nested Comment
            <div class="media">
                <a class="pull-left" href="#">
                    <img class="media-object" src="http://placehold.it/64x64" alt="">
                </a>
                <div class="media-body">
                    <h4 class="media-heading">Nested Start Bootstrap
                        <small>August 25, 2014 at 9:30 PM</small>
                    </h4>
                    Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin commodo. Cras purus odio, vestibulum in vulputate at, tempus viverra turpis. Fusce condimentum nunc ac nisi vulputate fringilla. Donec lacinia congue felis in faucibus.
                </div>
            </div>
            End Nested Comment

        </div>
    </div> --}}


@endsection


@section('category')
    <a href="#">{{$post->category->name}}</a>
@endsection

