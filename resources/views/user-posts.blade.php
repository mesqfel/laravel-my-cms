@extends('layouts.blog-home')

@section('content')

    <h1 class="page-header">
        Posts by {{$user}}
    </h1>

    @if(count($posts))

        @foreach($posts as $post)

            <h2>
                <a href="{{route('home.post', $post->slug)}}">{{$post->title}}</a>
            </h2>
            
            <p class="lead">
                by <a href="#">{{$post->user->name}}</a>
            </p>
                
            <p>
                <span class="glyphicon glyphicon-time"></span> Posted on {{$post->created_at->format('F j, Y \a\t g:ia')}}

                {{-- Category --}}
                <h5>
                    <a href="{{route('home.category.posts', strtolower($post->category->name))}}" style="cursor: pointer; text-decoration: none !important;">
                        <span class="label label-primary">
                            {{$post->category->name}}
                        </span>
                    </a>
                </h5>

            </p>

            <hr>        

            <a href="{{route('home.post', $post->slug)}}">
                <img class="img-responsive" src="{{$post->photo->path}}" style="margin: 0 auto; max-height: 400px;">
            </a> 
            
            <hr>

            <p>
                {{str_limit(strip_tags($post->body), 500)}}
            </p>

            <a class="btn btn-primary" href="{{route('home.post', $post->slug)}}">
                Read More <span class="glyphicon glyphicon-chevron-right"></span>
            </a>

            <hr>

        @endforeach


        <div style="text-align: center;">
            {{$posts->render()}}
        </div>


    @else

        <div class="alert alert-warning">
            
            No posts to show for this user

        </div>


    @endif




@endsection
