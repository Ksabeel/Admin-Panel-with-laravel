<?php

namespace App\Http\Controllers\Admin;

use App\Admin;
use App\Http\Controllers\Controller;
use App\Role;
use Illuminate\Http\Request;
use Session;
use Hash;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $admins = Admin::all();
        return view('admin.admins.index', compact('admins'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Role::all();
        return view('admin.admins.create', compact('roles'));
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
            'email'     => 'required|string|email|max:255|unique:admins',
        ]);

        $admin = new Admin;
        $admin->name = $request->name;
        $admin->email = $request->email;
        $admin->api_token = bin2hex(openssl_random_pseudo_bytes(30));

        if ($request->password) {
            $admin->password = Hash::make($request->password);
        } elseif ($request->auto_generate) {
            $admin->password = Hash::make('password');
        }
        $admin->save();
        $admin->roles()->sync($request->roles);

        Session::flash('success', 'Admin has been added successfully!');

        return redirect()->route('admins.index');
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
        $admin = Admin::findOrFail($id)->first();
        $roles = Role::all();
        return view('admin.admins.edit', compact('admin','roles'));
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

        $admin = Admin::findOrFail($id)->first();
        $admin->name = $request->name;

        if ($request->password_options == 'auto') {
            $admin->password = Hash::make('password');
        } elseif ($request->password_options == 'manual') {
            $admin->password = Hash::make($request->password);
        }
        
        $admin->save();

        if ($request->roles) {
            $admin->roles()->sync($request->roles);
        } else {
            $admin->roles()->sync(array());
        }

        Session::flash('success', 'Admin has been updated successfully!');

        return redirect()->route('admins.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $admin = Admin::findOrFail($id)->first();
        $admin->roles()->detach();
        $admin->delete();

        Session::flash('success', 'Admin has been deleted successfully!');

        return redirect()->route('admins.index');
    }
}
