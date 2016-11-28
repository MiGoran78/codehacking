<?php

namespace App\Http\Controllers;

use App\Http\Requests\UsersEditRequest;
use App\Http\Requests\UsersRequest;
use App\Photo;
use App\Role;
use App\User;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\File;
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
        $users = User::all();

        return view('admin.users.index', compact('users'));
    }



    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Role::lists('name', 'id')->all();

        return view('admin.users.create', compact('roles'));
    }



    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UsersRequest $request)
    {
//        User::create($request->all());


        if($request->password == ''){
            $input = $request->except('password');
        } else {
            $input = $request->all();
            $input['password'] = bcrypt($request->password);
        }


        if($file = $request->file('photo_id')){
            $name = time() . $file->getClientOriginalName();
            $file->move('images', $name);
            $photo = Photo::create(['file'=>$name]);
            $input['photo_id'] = $photo->id;
        }

        //$input['password'] = bcrypt($request->password);
        User::create($input);

        return redirect('/admin/users');



        //######  put all to db   ######
//        $input = $request->all();
//
//        $input['name'] = $request->name;
//        $input['email'] = $request->email;
//        $input['role_id'] = $request->role_id;
//        $input['is_active']= $request->is_active;
//        $input['photo_id']= $request->file('file');
//        $input['password']= bcrypt($request->password);
//
//        User::create($input);
//        return redirect('admin/users');


        //######  put all to db  ######
//        User::create($request->all());
//        return redirect('/admin/users');


        //######  display result  ######
//        return $request->all();
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
        $user = User::findOrFail($id);
        $roles = Role::lists('name', 'id')->all();

        return view('admin.users.edit', compact('user', 'roles'));
    }



    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UsersEditRequest $request, $id)
    {
        $user = User::findOrFail($id);


        if($request->password == ''){
            $input = $request->except('password');
        } else {
            $input = $request->all();
            $input['password'] = bcrypt($request->password);
        }


        if($file = $request->file('photo_id')) {

            $name = time() . $file->getClientOriginalName();
            $file->move('images', $name);

            $photo = Photo::create(['file'=>$name]);
            $input['photo_id'] = $photo->id;
        }

        $user->update($input);

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
        //delete from images folder
        $user = User::findOrFail($id);

        if (File::exists(public_path() . $user->photo->file)){
            unlink(public_path() . $user->photo->file);
            $user->delete();
        }


        //delete RS from DB
        if($user->photo) {
            //$photo = User::where('photo_id', $user->photo_id)->first();
            $photo = Photo::findOrFail($user->photo->id);
            $photo->delete();
        }


        Session::flash('deleted_user', 'The user has been deleted');
        return redirect('/admin/users');
    }
}
