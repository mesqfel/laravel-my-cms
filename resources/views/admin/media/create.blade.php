 @extends('layouts.admin')

 @section('styles')

	 <link href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/4.3.0/min/dropzone.min.css" rel="stylesheet">

 @endsection


 @section('content')

	<h1 class="page-header">Upload Image</h1>

	{!! Form::open(['method' => 'POST', 'action' => 'AdminMediaController@store', 'class' => 'dropzone']) !!}


	{!! Form::close() !!}


 @endsection


 @section('footer')

	 <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/4.3.0/min/dropzone.min.js"></script>

 @endsection

 