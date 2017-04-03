<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Session;
use App\Http\Requests;

use App\Photo;

class AdminMediaController extends Controller
{
    
    public function index()
    {

        $photos = Photo::latest()->get();
        return view('admin.media.index', compact('photos'));
    }

    public function create()
    {
        return view('admin.media.create');
    }

    public function store(Request $request)
    {
        
    	$file = $request->file('file');

    	$name = time().'_'.$file->getClientOriginalName();
    	$file->move('images', $name);
    	Photo::create(['path' => $name]);
    }

    public function destroy($id)
    {
        $photo = Photo::findOrFail($id);

        $imgPath = public_path().$photo->path;

        $photo->delete();
        
		unlink($imgPath);

        Session::flash('crudMediaMsg', 'The image has been deleted successfully');

        return redirect('/admin/media');
    }

}
