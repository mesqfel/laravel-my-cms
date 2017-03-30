<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Requests\CreateUserRequest;
use App\Http\Requests\EditUserRequest;
use Illuminate\Support\Facades\Auth;

use App\User;
use App\Role;
use App\Photo;

class AdminUsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $users = User::latest()->get();
        $loggedUser = Auth::user();
        
        return view('admin.users.index', compact('loggedUser', 'users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $roles = Role::lists('name', 'id');
        $loggedUser = Auth::user();

        return view('admin.users.create', compact('loggedUser','roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  App\Http\Requests\CreateUserRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateUserRequest $request)
    {

        $inputs = $request->all();

        if($file = $request->file('photo_id')){
            $name = time().'_'.$file->getClientOriginalName();
            $file->move('images/users', $name);
            $photo = Photo::create(['path' => $name]);
            $inputs['photo_id'] = $photo->id;
        }

        $inputs['password'] = bcrypt($request->password);

        User::create($inputs);

        return redirect('/admin/users');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return view('admin.users.show');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        $user = User::find($id);
        $loggedUser = Auth::user();

        if(!$user)
            return redirect('/admin');

        $roles = Role::lists('name', 'id');

        return view('admin.users.edit', compact('loggedUser', 'user', 'roles'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(EditUserRequest $request, $id)
    {
        $user = User::findOrFail($id);

        $inputs = $request->all();

        if($file = $request->file('photo_id')){
            $name = time().'_'.$file->getClientOriginalName();
            $file->move('images/users', $name);
            $photo = Photo::create(['path' => $name]);
            $inputs['photo_id'] = $photo->id;
        }

        $user->update($inputs);

        return redirect('/admin/users');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::findOrFail($id)->delete();

        return redirect('/admin/users');
    }
}
