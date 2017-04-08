@extends('layouts.blog-home')

@section('content')

    
    <!-- Title -->
    <h1 class="page-header" style="border-bottom: 0px; margin-bottom: 0px;">{{$post->title}}</h1>

    <!-- Author -->
    <p class="lead">
        by <a href="{{route('home.user.posts', $post->user->slug)}}">{{$post->user->name}}</a>
    </p>

    <hr>

    <!-- Date/Time -->
    <p><span class="glyphicon glyphicon-time"></span> Posted on {{$post->created_at->format('F j, Y \a\t g:ia')}}</p>
    
    {{-- Category --}}
    <h5>
        <a href="{{route('home.category.posts', strtolower($post->category->name))}}" style="cursor: pointer; text-decoration: none !important;">
            <span class="label label-primary">
                {{$post->category->name}}
            </span>
        </a>
    </h5>

    

    <hr>

    <!-- Preview Image -->
    <img class="img-responsive" src="{{$post->photo->path}}" style="margin: 0 auto; max-height: 400px;">
    

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

            {!! Form::hidden('post_id', $post->id) !!}
            {!! Form::hidden('is_active', 1) !!}

            {{ csrf_field() }}

            <div class="form-group">

                {!! Form::textarea('body', null, ['class' => 'form-control', 'rows' => 3]) !!}

            </div>

            <div class="form-group">

                {!! Form::button('Submit', ['class' => 'btn btn-primary', 'id' => 'submitComment']); !!}

            </div>

    </div>

    <hr>

    <!-- Posted Comments -->

    <!-- Comment -->

    <div id="divComments">

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

                            <div class="div-reply" style="display: none;">
                                {{-- {!! Form::open(['method' => 'POST', 'action' => 'CommentRepliesController@store', 'style' => "display: none;"]) !!} --}}

                                    {{ csrf_field() }}
                                    {!! Form::hidden('comment_id', $_comment->id) !!}
                                    {!! Form::hidden('is_active', 1) !!}

                                    <div class="form-group div-reply-textarea">

                                        {!! Form::textarea('body', null, ['class' => 'form-control', 'placeholder' => 'Reply...', 'rows' => 1]) !!}

                                    </div>

                                    <div class="form-group">

                                        {!! Form::button('Reply', ['class' => 'btn btn-primary btn-reply']); !!}

                                    </div>

                                {{-- {!! Form::close() !!} --}}
                            </div>
                        
                        </div>

                    </div>
                </div>

            @endif

        @endforeach

    </div>

@endsection

@section('scripts')

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-dateFormat/1.0/jquery.dateFormat.min.js"></script>


    <script type="text/javascript">


        $(document).ready(function(){

            // Submit a comment via AJAX
            $(document).on('click', '#submitComment', function(){

                data = {
                    '_token' : $(this).parent().parent().children('[name="_token"]').val(),
                    'post_id' : $(this).parent().parent().children('[name="post_id"]').val(),
                    'is_active' : $(this).parent().parent().children('[name="is_active"]').val(),
                    'body' : $(this).parent().prev().children().val(),
                };

                var commentTextareaElem = $(this).parent().prev().children();

                $.post("{{route('admin.comments.store')}}", data)
                    .done(function( res ) {

                        var html = '';

                        html += '<div class="media">';
                            html += '<a class="pull-left" href="#">';

                                if(res.photo)
                                    html += '<img height="40" class="media-object" src="'+res.photo+'" alt="">';
                                else
                                    html += '<img height="40" class="media-object" src="/images/profile-placeholder.jpg" alt="">';
                                    
                            html += '</a>';
                            html += '<div class="media-body">';
                                html += '<h4 class="media-heading">';
                                    html += res.author;
                                    html += ' <small>'+$.format.date(res.created_at, "MMMM d, yyyy")+' at '+$.format.date(res.created_at, "h:mma")+'</small>';
                                html += '</h4>';
                                    html += res.body;
                                html += '<p>';
                                    html += '<a href="javascript:void(0);" style="font-size: 13px;" class="reply-comment">';
                                        html += '<i class="fa fa-comment-o"></i> Reply';
                                    html += '</a>';
                                html += '</p>';
                                html += '<div class="media">';
                                    html += '<div></div>';
                                    html += '<div class="div-reply" style="display: none;">';
                                        html += '{{ csrf_field() }}';
                                        html += '<input name="comment_id" type="hidden" value="'+res.id+'">';
                                        html += '<input name="is_active" type="hidden" value="1">';
                                        html += '<div class="form-group div-reply-textarea">';
                                            html += '<textarea class="form-control" placeholder="Reply..." rows="1" name="body" cols="50"></textarea>';
                                        html += '</div>';
                                        html += '<div class="form-group">';
                                            html += '<input class="btn btn-primary btn-reply" type="submit" value="Reply">';
                                        html += '</div>';
                                    html += '</div>';
                                html += '</div>';
                            html += '</div>';
                        html += '</div>';
                        
                        $('#divComments').prepend(html);

                        commentTextareaElem.val('');

                    })
                    .fail(function(err) {
                        console.log('error!!');
                        console.log(err);
                    });
            });

            // Clicked to show reply comment form
            $(document).on('click', '.reply-comment', function(){

                $(this).parent().next().children('.div-reply').show();
                $(this).parent().next().children('.div-reply').children('.div-reply-textarea').children('textarea').focus();

            });

            // Submit a reply via AJAX
            $(document).on('click', '.btn-reply', function(){

                var repliesDiv = $(this).parent().parent().parent().children('div:first');
                var replyTextarea = $(this).parent().prev().children();

                data = {
                    '_token' : $(this).parent().parent('.div-reply').children('[name="_token"]').val(),
                    'comment_id' : $(this).parent().parent('.div-reply').children('[name="comment_id"]').val(),
                    'is_active' : $(this).parent().parent('.div-reply').children('[name="is_active"]').val(),
                    'body' : $(this).parent().parent('.div-reply').children('.div-reply-textarea').children('[name="body"]').val(),
                };

                var replyTextareaElem = $(this).parent().parent('.div-reply').children('.div-reply-textarea').children('[name="body"]');

                $.post("{{route('admin.comment.replies.store')}}", data)
                    .done(function( res ) {

                        var html = '';

                        html += '<div class="media">';
                            html += '<a class="pull-left" href="#">';

                                if(res.photo)
                                    html += '<img height="40" class="media-object" src="'+res.photo+'" alt="">';
                                else
                                    html += '<img height="40" class="media-object" src="/images/profile-placeholder.jpg" alt="">';

                            html += '</a>';

                            html += '<div class="media-body">';
                                html += '<h4 class="media-heading">';
                                    
                                    html += res.author;
                                    html += ' <small>'+$.format.date(res.created_at, "MMMM d, yyyy")+' at '+$.format.date(res.created_at, "h:mma")+'</small>';

                                html += '</h4>';
                                
                                html += res.body;

                            html += '</div>';
                        html += '</div>';

                        if(!$.trim(repliesDiv.html())){
                            repliesDiv.css('margin-bottom', '15px');
                        }

                        repliesDiv.append(html);
                        replyTextarea.val('');

                    })
                    .fail(function(err) {
                        console.log('error!!');
                        console.log(err);
                    });

            });

        });

    </script>



@endsection
