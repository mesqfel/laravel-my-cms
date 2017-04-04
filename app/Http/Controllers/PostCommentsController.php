<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Requests\CommentRequest;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

use App\Post;
use App\Comment;

class PostCommentsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $comments = Comment::latest()->paginate(10);
        
        return view('admin.comments.index', compact('comments'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CommentRequest $request)
    {
        
        $user = Auth::user();

        $userPhotoPath = '';
        if($user->photo){
            $userPhotoPath = $user->photo->path;
        }

        $data = [
            'post_id' => $request->post_id,
            'author' => $user->name,
            'email' => $user->email,
            'photo' => $userPhotoPath,
            'body' => $request->body
        ];

        Comment::create($data);

        Session::flash('crudCommentMsg', 'Your comment has been submitted and is waiting for moderation approval');

        return redirect()->back();
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
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    public function moderate(Request $request, $id)
    {

        $comment = Comment::findOrFail($id);

        $data = [
            'is_active' => !$request->is_active
        ];

        $comment->update($data);

        if(!$request->is_active)
            Session::flash('crudCommentMsg', 'The comment has been approved successfully');
        else
            Session::flash('crudCommentMsg', 'The comment has been rejected successfully');
        
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $comment = Comment::findOrFail($id);

        $comment->delete();

        Session::flash('crudCommentMsg', 'The comment has been deleted successfully');

        return redirect()->back();
    }

    public function showReplies($id)
    {

        $comment = Comment::find($id);

        if(!$comment)
            return redirect(404);

        $comment->replies = $comment->replies()->latest()->paginate(10);

        return view('admin.comments.replies', compact('comment'));
    }

}
