<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Role;
use Hash;
use Illuminate\Http\Request;
use Session;

class UserController extends Controller
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
        $roles = Role::all();
        return view('admin.users.create', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'      => 'required|string|max:255',
            'email'     => 'required|string|email|max:255|unique:users',
        ]);

        $user = new User;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->api_token = bin2hex(openssl_random_pseudo_bytes(30));

        if ($request->password) {
            $user->password = Hash::make($request->password);
        } elseif ($request->auto_generate) {
            $user->password = Hash::make('password');
        }
        $user->save();
        $user->roles()->sync($request->roles);

        Session::flash('success', 'User has been added successfully!');

        return redirect()->route('users.index');
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
        $roles = Role::all();
        return view('admin.users.edit', compact('user','roles'));
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
        $request->validate(['name' => 'required|string|max:255']);

        $user = User::findOrFail($id);
        $user->name = $request->name;

        if ($request->password_options == 'auto') {
            $user->password = Hash::make('password');
        } elseif ($request->password_options == 'manual') {
            $user->password = Hash::make($request->password);
        }
        
        $user->save();

        if ($request->roles) {
            $user->roles()->sync($request->roles);
        } else {
            $user->roles()->sync(array());
        }

        Session::flash('success', 'User has been updated successfully!');

        return redirect()->route('users.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->roles()->detach();
        $user->delete();

        Session::flash('success', 'User has been deleted successfully!');

        return redirect()->route('users.index');
    }
}
