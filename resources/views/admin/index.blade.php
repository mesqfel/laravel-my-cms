@extends('layouts.admin')



@section('content')

	<div class="row">
		<div class="col-lg-12">
			<h1 class="page-header">Dashboard</h1>
		</div>
	</div>


	<div class="row" style="margin-top: 40px;">
	    
	    <div class="col-lg-3 col-md-6">
		    <a href="{{route('admin.users.index')}}">
		        <div class="panel panel-primary">
		            <div class="panel-heading">
		                <div class="row">
		                    <div class="col-xs-3">
		                        <i class="fa fa-users fa-5x"></i>
		                    </div>
		                    <div class="col-xs-9 text-right">
		                        <div class="huge">{{$dashInfo['users']}}</div>
		                        <div>Users</div>
		                    </div>
		                </div>
		            </div>
		            
	                <div class="panel-footer">
	                    <span class="pull-left">View Users</span>
	                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
	                    <div class="clearfix"></div>
	                </div>
		        </div>
			</a>
	    </div>

	    <div class="col-lg-3 col-md-6">
		    <a href="{{route('admin.posts.index')}}" style="color: green;">
		        <div class="panel panel-green">
		            <div class="panel-heading">
		                <div class="row">
		                    <div class="col-xs-3">
		                        <i class="fa fa-file-text-o fa-5x"></i>
		                    </div>
		                    <div class="col-xs-9 text-right">
		                        <div class="huge">{{$dashInfo['posts']}}</div>
		                        <div>Posts</div>
		                    </div>
		                </div>
		            </div>
		            
	                <div class="panel-footer">
	                    <span class="pull-left">View Posts</span>
	                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
	                    <div class="clearfix"></div>
	                </div>
		        </div>
	        </a>	
	    </div>

	    <div class="col-lg-3 col-md-6">
	        <a href="{{route('admin.categories.index')}}" style="color: orange;">
		        <div class="panel panel-yellow">
		            <div class="panel-heading">
		                <div class="row">
		                    <div class="col-xs-3">
		                        <i class="fa fa-folder-o fa-5x"></i>
		                    </div>
		                    <div class="col-xs-9 text-right">
		                        <div class="huge">{{$dashInfo['categories']}}</div>
		                        <div>Categories</div>
		                    </div>
		                </div>
		            </div>
		            
	                <div class="panel-footer">
	                    <span class="pull-left">View Categories</span>
	                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
	                    <div class="clearfix"></div>
	                </div>
		        </div>
	        </a>
	    </div>

	    <div class="col-lg-3 col-md-6">
		    <a href="{{route('admin.media.index')}}" style="color: red;">
		        <div class="panel panel-red">
		            <div class="panel-heading">
		                <div class="row">
		                    <div class="col-xs-3">
		                        <i class="fa fa-file-image-o fa-5x"></i>
		                    </div>
		                    <div class="col-xs-9 text-right">
		                        <div class="huge">{{$dashInfo['photos']}}</div>
		                        <div>Images</div>
		                    </div>
		                </div>
		            </div>
		            
	                <div class="panel-footer">
	                    <span class="pull-left">View Images</span>
	                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
	                    <div class="clearfix"></div>
	                </div>
		        </div>
	        </a>
	    </div>

	</div>


@endsection