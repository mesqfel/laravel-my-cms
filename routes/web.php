<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

Route::get('/', ['as'=>'home.index', 'uses' => 'HomeController@index']);

Route::get('/category/{category}/posts', ['as'=>'home.category.posts', 'uses' => 'HomeController@postsByCategory']);

Route::get('/user/{user}/posts', ['as'=>'home.user.posts', 'uses' => 'HomeController@postsByUser']);

Route::get('/logout', 'Auth\LoginController@logout');

Route::auth();

Route::get('/post/{id}', ['as'=>'home.post', 'uses' => 'AdminPostsController@post']);


Route::group(['middleware' => 'admin'], function(){

	Route::get('/admin', ['as'=>'admin.index', 'uses' => 'AdminDashboardController@index']);

	Route::resource('/admin/users', 'AdminUsersController', [
		'names' => [
			'index' => 'admin.users.index',
			'show' => 'admin.users.show',
			'create' => 'admin.users.create',
			'store' => 'admin.users.store',
			'edit' => 'admin.users.edit',
			'update' => 'admin.users.update',
			'destroy' => 'admin.users.destroy'
		]
	]);

	Route::get('/admin/user/{id}/posts', ['as'=>'admin.user.posts', 'uses' => 'AdminUsersController@postsByUser']);

	Route::resource('/admin/posts', 'AdminPostsController', [
		'names' => [
			'index' => 'admin.posts.index',
			'show' => 'admin.posts.show',
			'create' => 'admin.posts.create',
			'store' => 'admin.posts.store',
			'edit' => 'admin.posts.edit',
			'update' => 'admin.posts.update',
			'destroy' => 'admin.posts.destroy'
		]
	]);

	Route::post('/admin/posts/multidestroy', ['as'=>'admin.posts.multidestroy', 'uses' => 'AdminPostsController@multipleDestroy']);

	Route::get('/admin/posts/{id}/comments', ['as'=>'admin.posts.comments', 'uses' => 'AdminPostsController@showComments']);

	Route::resource('/admin/categories', 'AdminCategoriesController', [
		'names' => [
			'index' => 'admin.categories.index',
			'show' => 'admin.categories.show',
			'create' => 'admin.categories.create',
			'store' => 'admin.categories.store',
			'edit' => 'admin.categories.edit',
			'update' => 'admin.categories.update',
			'destroy' => 'admin.categories.destroy'
		]
	]);

	Route::get('/admin/category/{id}/posts', ['as'=>'admin.category.posts', 'uses' => 'AdminCategoriesController@postsByCategory']);

	Route::resource('/admin/media', 'AdminMediaController', [
		'names' => [
			'index' => 'admin.media.index',
			'show' => 'admin.media.show',
			'create' => 'admin.media.create',
			'store' => 'admin.media.store',
			'edit' => 'admin.media.edit',
			'update' => 'admin.media.update',
			'destroy' => 'admin.media.destroy'
		]
	]);

	Route::resource('/admin/comments', 'PostCommentsController', [
		'names' => [
			'index' => 'admin.comments.index',
			'show' => 'admin.comments.show',
			'create' => 'admin.comments.create',
			'store' => 'admin.comments.store',
			'edit' => 'admin.comments.edit',
			'update' => 'admin.comments.update',
			'destroy' => 'admin.comments.destroy'
		]
	]);

	Route::patch('/admin/comments/moderate/{id}', ['as'=>'admin.comments.moderate', 'uses' => 'PostCommentsController@moderate']);

	Route::get('/admin/comments/{id}/replies', ['as'=>'admin.comments.replies', 'uses' => 'PostCommentsController@showReplies']);

	Route::patch('/admin/comment-reply/moderate/{id}', ['as'=>'admin.comment_reply.moderate', 'uses' => 'CommentRepliesController@moderate']);

	Route::resource('/admin/comment/replies', 'CommentRepliesController', [
		'names' => [
			'index' => 'admin.replies.index',
			'show' => 'admin.replies.show',
			'create' => 'admin.replies.create',
			'store' => 'admin.replies.store',
			'edit' => 'admin.replies.edit',
			'update' => 'admin.replies.update',
			'destroy' => 'admin.replies.destroy'
		]
	]);

});

Route::group(['middleware' => 'auth'], function(){

	Route::post('/admin/comments', ['as'=>'admin.comments.store', 'uses' => 'PostCommentsController@store']);

	Route::post('/admin/comment/replies', ['as'=>'admin.comment.replies.store', 'uses' => 'CommentRepliesController@store']);

});