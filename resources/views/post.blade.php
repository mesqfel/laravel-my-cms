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

    <p> {!! $post->body !!} </p>

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
            {!! Form::hidden('is_active', 1) !!}

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
                            <img height="40" class="media-object" src="{{$_comment->photo}}" alt="">
                        @else
                            <img height="40" class="media-object" src="/images/profile-placeholder.jpg" alt="">
                        @endif

                    </a>
                    <div class="media-body">
                        <h4 class="media-heading">

                            {{$_comment->author}}

                            <small>{{$_comment->created_at->format('F j, Y \a\t g:ia')}}</small>
                        </h4>

                        {{$_comment->body}}

                        <p>
                            <a href="javascript:void(0);" style="font-size: 13px;" class="reply-comment">
                                <i class="fa fa-comment-o"></i> Reply
                            </a>
                        </p>

                        <div class="media">

                            <?php
                                $repliesSectionMarginBottom = '';
                                if(count($_comment->replies)) 
                                    $repliesSectionMarginBottom = 'margin-bottom: 15px;';
                            ?>

                            <div style="{{$repliesSectionMarginBottom}}">

                                {{-- replies --}}
                                @if(count($_comment->replies))


                                    @foreach($_comment->replies as $reply)

                                        @if($reply->is_active)

                                            <div class="media">
                                                <a class="pull-left" href="#">
                                                    {{-- <img class="media-object" src="http://placehold.it/64x64" alt=""> --}}

                                                    @if($reply->photo)
                                                        <img height="40" class="media-object" src="{{$reply->photo}}" alt="">
                                                    @else
                                                        <img height="40" class="media-object" src="/images/profile-placeholder.jpg" alt="">
                                                    @endif

                                                </a>
                                                <div class="media-body">
                                                    <h4 class="media-heading">
                                                        {{$reply->author}}

                                                        <small>{{$reply->created_at->format('F j, Y \a\t g:ia')}}</small>
                                                    </h4>
                                                    {{$reply->body}}

                                                </div>
                                            </div>

                                        @endif

                                    @endforeach

                                @endif

                            </div>

                            <div>
                                {!! Form::open(['method' => 'POST', 'action' => 'CommentRepliesController@store', 'style' => "display: none;"]) !!}

                                    {!! Form::hidden('comment_id', $_comment->id) !!}
                                    {!! Form::hidden('is_active', 1) !!}

                                    <div class="form-group div-reply">

                                        {!! Form::textarea('body', null, ['class' => 'form-control', 'placeholder' => 'Reply...', 'rows' => 1]) !!}

                                    </div>

                                    <div class="form-group">

                                        {!! Form::submit('Reply', ['class' => 'btn btn-primary']); !!}

                                    </div>

                                {!! Form::close() !!}
                            </div>
                        
                        </div>

                    </div>
                </div>

            @endif

        @endforeach

    </div>

@endsection


@section('category')
    <a href="#">{{$post->category->name}}</a>
@endsection


@section('scripts')


    <script type="text/javascript">


        $(document).ready(function(){

            $(document).on('click', '.reply-comment', function(){

                $(this).parent().next().children().last().children().show();
                $(this).parent().next().children().last().children().children('.div-reply').children('textarea').focus();

            });

        });

    </script>



@endsection
