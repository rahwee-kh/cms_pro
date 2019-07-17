<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Http\Requests\UserEditRequest;
use App\Photo;
use App\Role;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class AdminUserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
/*
        users = User::all();
        foreach($users as $user){
            $name = $user->name;
            return $name[0];
        }

*/
        $users = User::all();

        //get the current user
        $auth = Auth::user();
        // get the Auth::user() by Session
        //Session::flash('current_user_name', $auth->name);


        //return $auth->id;
        return view('admin.users.index', compact('users','auth'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Role::lists('name','id')->all();
        return view('admin.users.create',compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserRequest $request)
    {

        if (trim($request->password) == ''){

            $input = $request->except('password');

        }else{

            $input = $request->all();
            $input['password'] = bcrypt($request->password);

        }



        if ($photo_file  = $request->file('photo_id')){

            $file_name = time().$photo_file->getClientOriginalName();

            $photo_file->move('images', $file_name);

            $photo = Photo::create(['file'=>$file_name]);

            $input['photo_id'] = $photo->id;


        }


        User::create($input);
        Session::flash('action', 'This user has been created');




        return redirect('/admin/users/create');

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
        $user = User::findOrFail($id);
        $roles = Role::lists('name','id')->all();
        return view('admin.users.edit',compact('user','roles'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UserEditRequest $request, $id)
    {

        //return $request->all();

        $user = User::findOrFail($id);
        Session::flash('action', 'This user has been updated');

        if (trim($request->password) == ''){

            $input = $request->except('password');

        }else{

            $input = $request->all();
            $input['password'] = bcrypt($request->password);
        }

        if ($file = $request->file('photo_id')){

            $name = time().$file->getClientOriginalName();

            $file->move('images', $name);

            $photo = Photo::create(['file'=> $name]);

            $input['photo_id'] = $photo->id;

        }


        $user->update($input);
        //return $user->id;
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
        //

        $user = User::findOrFail($id);

        // this delete photo from images folder
        unlink(public_path() . $user->photo->file);

        // Delete photo from photos table
        $photo = Photo::whereId($user->photo_id);
        $photo->delete();
        $user->delete();

        Session::flash('action', 'This user has been deleted');

        return redirect('admin/users');
    }
}
