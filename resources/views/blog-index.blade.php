@extends('layouts.blog-home')

@section('content')

    <h1 class="page-header">
        Latests Articles
    </h1>

    @foreach($posts as $post)

        <h2>
            <a href="{{route('home.post', $post->slug)}}">{{$post->title}}</a>
        </h2>
        
        <p class="lead">
            by <a href="index.php">{{$post->user->name}}</a>
        </p>
            
        <p>
            <span class="glyphicon glyphicon-time"></span> Posted on {{$post->created_at->format('F j, Y \a\t g:ia')}}
            <h5><span class="label label-primary">{{$post->category->name}}</span></h5>
        </p>

        <hr>        

        <img class="img-responsive" src="{{$post->photo->path}}" style="margin: 0 auto; max-height: 400px;">
        
        <hr>

        <p>
            {{str_limit(strip_tags($post->body), 500)}}
        </p>

        <a class="btn btn-primary" href="{{route('home.post', $post->slug)}}">Read More <span class="glyphicon glyphicon-chevron-right"></span></a>

        <hr>

    @endforeach


    <div style="text-align: center;">
        {{$posts->render()}}
    </div>

@endsection
