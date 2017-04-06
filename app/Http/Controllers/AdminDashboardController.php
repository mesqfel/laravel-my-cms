<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\User;
use App\Post;
use App\Category;
use App\Photo;

class AdminDashboardController extends Controller
{
    public function index()
    {

    	// return 'admin index';

    	// dd(User::count());

    	$dashInfo = [
    		'users' => User::count(),
    		'posts' => Post::count(),
    		'categories' => Category::count(),
    		'photos' => Photo::count()
    	];

        return view('admin.index', compact('dashInfo'));
    }
}
