<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Permission;
use Illuminate\Http\Request;
use Session;

class PermissionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $permissions = Permission::all();
        return view('admin.permissions.index', compact('permissions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.permissions.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if ($request->permission_type == 'basic') {
            
            $request->validate([
                'name'        => 'required|max:255|unique:permissions',
                'slug'        => 'required|max:255|alpha_dash',
                'description' => 'sometimes|max:255' 
            ]);

            $permission = new Permission;
            $permission->name = $request->name;
            $permission->slug = $request->slug;
            $permission->description = $request->description;
            $permission->save();

            Session::flash('success', 'Permission has been successfully added!');
            return redirect()->route('permissions.index');

        } elseif ($request->permission_type == 'crud') {
            $request->validate([ 'resource' => 'required|min:3|max:100|alpha' ]);

            $crud = explode(',', $request->crud_selected);
            if (count($crud) > 0) {
                foreach ($crud as $x) {
                    $name = ucwords($x ." ". $request->resource);
                    $slug = strtolower($x ."-". $request->resource);
                    $description = "Allow a User to " . strtoupper($x) ." a ". $request->resource;

                    $permission = new Permission;
                    $permission->name = $name;
                    $permission->slug = $slug;
                    $permission->description = $description;
                    $permission->save();

                }
                    Session::flash('success', 'Permission were all successfully added!');
                    return redirect()->route('permissions.index');
            } else {
                return redirect()->route('permissions.create')->withInput();
            }
        }
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
        $permission = Permission::findOrFail($id)->first();
        return view('admin.permissions.edit', compact('permission'));
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
        $request->validate([
            'name'        => "required|max:255|unique:permissions,name,$id",
            'description' => 'sometimes|max:255' 
        ]);

        $permission = Permission::findOrFail($id)->first();
        $permission->name = $request->name;
        $permission->description = $request->description;
        $permission->save();

        Session::flash('success', "Updated the $permission->name permission");

        return redirect()->route('permissions.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Permission::findOrFail($id)->delete();

        Session::flash('success', 'Permission has been successfully deleted!');

        return redirect()->route('permissions.index');
    }
}
