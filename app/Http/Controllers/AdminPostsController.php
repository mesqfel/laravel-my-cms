<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Requests\CreatePostRequest;
use App\Http\Requests\EditPostRequest;

use App\Post;
use App\User;
use App\Photo;
use App\Category;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class AdminPostsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $posts = Post::latest()->paginate(10);
        
        return view('admin.posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $categories = Category::pluck('name', 'id');

        return view('admin.posts.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreatePostRequest $request)
    {
        $inputs = $request->all();

        if($file = $request->file('photo_id')){
            $name = time().'_'.$file->getClientOriginalName();
            $file->move('images', $name);
            $photo = Photo::create(['path' => $name]);
            $inputs['photo_id'] = $photo->id;
        }

        $user = Auth::user();

        $user->posts()->create($inputs);

        Session::flash('crudPostMsg', 'The post has been created successfully');

        return redirect('/admin/posts');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post = Post::find($id);

        if(!$post)
            return redirect(404);

        $categories = Category::pluck('name', 'id');

        return view('admin.posts.edit', compact('post', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(EditPostRequest $request, $id)
    {

        $post = Post::findOrFail($id);

        $inputs = $request->all();

        if($file = $request->file('photo_id')){
            $name = time().'_'.$file->getClientOriginalName();
            $file->move('images', $name);
            $photo = Photo::create(['path' => $name]);
            $inputs['photo_id'] = $photo->id;
        }

        $post->slug = null;
        $post->update($inputs);

        Session::flash('crudPostMsg', 'The post has been edited successfully');

        return redirect('/admin/posts');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Post::findOrFail($id);

        $imgPath = '';
        if($photo = $post->photo){
            $imgPath = public_path().$post->photo->path;
        }

        $post->delete();
        
        if($imgPath){
            unlink($imgPath);
            $photo->delete();
        }

        Session::flash('crudPostMsg', 'The post has been deleted successfully');

        return redirect('/admin/posts');
    }

    public function post($slug)
    {
        $post = Post::where('slug', $slug)->get()->first();

        if(!$post)
            return redirect(404);

        $post->comments = $post->comments()->latest()->get();
        
        return view('post', compact('post'));
    }

    public function showComments($id)
    {

        $post = Post::find($id);

        if(!$post)
            return redirect(404);

        $post->comments = $post->comments()->latest()->get();
        
        return view('admin.posts.comments', compact('post'));
    }

    public function multipleDestroy(Request $request)
    {

        $postsIdToBeDeleted = $request->postsCheckboxArray;

        foreach ($postsIdToBeDeleted as $postId) {

            $post = Post::findOrFail($postId);

            $imgPath = '';
            if($photo = $post->photo){
                $imgPath = public_path().$post->photo->path;
            }

            $post->delete();
            
            if($imgPath){
                unlink($imgPath);
                $photo->delete();
            }
            
        }

        if(count($postsIdToBeDeleted) > 1)
            Session::flash('crudPostMsg', 'The posts have been deleted successfully');
        else
            Session::flash('crudPostMsg', 'The post has been deleted successfully');

        return redirect('/admin/posts');
    }


}
