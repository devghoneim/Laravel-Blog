<?php

namespace App\Http\Controllers;

use  App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class UserController extends Controller
{

     



    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::orderBy('id','DESC')-> paginate(10);
        return view('users.index',compact('users'));

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('users.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data= $request->validate([
            'name'=>['required','string','max:50'],
            'email'=>['required','email','unique:users,email'],
            'password'=>['required','string','min:8','max:20'],
            'conPassword'=>['required','string','min:8','max:20','same:password'],
            'type'=>['required','in:admin,writer']

        ]);
        user::create($data);
        return back()->with('success',"User Added Successfully");
    }

    /**
     * Display the specified resource.
     */
    public function posts(string $id)
    {
        $user = User::findOrFail($id);
        return view('users.posts',compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $user = User::findOrFail($id);
        return view('users.edit',compact('user'));
        
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $user = User::findOrFail($id);
        $data= $request->validate([
            'name'=>['required','string','max:50'],
            'email'=>['required','email',\Illuminate\Validation\Rule::unique('users')->ignore($user->id)],
            'password'=>['nullable','string','min:8','max:20'],
            'conPassword'=>['nullable','string','min:8','max:20','same:password'],
            'type'=>['required','in:admin,writer']

        ]);
        $data['password'] = $request->has('password') ? bcrypt($request->password) : $user->password;
        unset($data['conPassword']);
        User::where('id',$id)->update($data);
        return back()->with('success',"User Updated Successfully");



    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = User::findOrFail($id);
        User::destroy($id);
        return back()->with("success","User Deleted Successfully");

    }
}
