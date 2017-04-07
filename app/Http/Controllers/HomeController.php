<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;

use App\Post;
use App\User;
use App\Category;

class HomeController extends Controller
{

    /**
     * Show the latests posts
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $posts = Post::latest()->paginate(10);
        
        return view('index', compact('posts'));
    }

    /**
     * Show the latests posts by category
     *
     * @return \Illuminate\Http\Response
     */
    public function postsByCategory($category)
    {

        $category = Category::where('name', ucfirst(strtolower($category)))->get()->first();

        if(!$category)
            return redirect(404);

        $posts = $category->posts()->latest()->paginate(10);
        $category = $category->name;

        return view('category-posts', compact('posts', 'category'));
    }

    /**
     * Show the latests posts by user
     *
     * @return \Illuminate\Http\Response
     */
    public function postsByUser($slug)
    {

        $user = User::where('slug', $slug)->get()->first();

        if(!$user)
            return redirect(404);

        $posts = $user->posts()->latest()->paginate(10);
        $user = $user->name;

        return view('user-posts', compact('posts', 'user'));
    }
}
