<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\Permission;
use Illuminate\Http\Request;
use Str;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.roles.index',[
            'roles' => Role::all(),
        ]);
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
    public function store(Request $request)
    {
        request()->validate([
            'name' => ['required']
        ]);

        Role::create([
           'name' => Str::ucfirst(request('name')),
            'slug' => Str::slug(request('name')),
        ]);

        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function show(Role $role)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function edit(Role $role)
    {
        return view('admin.roles.edit',[
            'roles'=>$role,
            'permissions' => Permission::all(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Role $role)
    {
        $role->name = Str::ucfirst(request('name'));
        $role->slug = Str::slug(request('name'));

        if($role->isDirty('name')){
            session()->flash('role-updated', 'successfully updated role with name ' . Str::ucfirst($role->name));
            $role->save();
        }
        else{
            session()->flash('role-updated', 'nothing to update ');
        }

        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function destroy(Role $role)
    {
        $role->delete();

        session()->flash('role-delete','Deleted role ' .$role->name);

        return back();
    }

    public function attach_permissions(Role $role){
        $role->permissions()->attach(request('permission'));
        return back();
    }

    public function detach_permissions(Role $role){
        $role->permissions()->detach(request('permission'));

        return back();
    }

}
