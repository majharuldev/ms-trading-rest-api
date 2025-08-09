<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Illuminate\Foundation\Auth\User;
use Spatie\Permission\Models\Permission;


class RoleController extends Controller
{
    // get all permisson
    public function index()
    {
        $data = Permission::all();

        return response()->json([
            'status' => 'Success',
            'data' => $data
        ], 200);
    }



    

    // save permission 
    public function store(Request $request)
    {
        $data = Permission::create($request->all());

        return response()->json([
            'status' => 'Success',
            'data' => $data
        ], 200);
    }

    // get permission by id
    public function show($id)
    {
        $data = Permission::findOrFail($id);

        return response()->json([
            'status' => 'Success',
            'data' => $data
        ], 200);
    }

    // update permission by id
    public function update(Request $request, $id)
    {
        $data = Permission::findOrFail($id);
        $data->update($request->all());

        return response()->json([
            'status' => 'Success',
            'data' => $data
        ], 200);
    }

    // permisiion delete
    public function destroy($id)
    {
        $data = Permission::findOrFail($id);
        $data->delete();

        return response()->json([
            'status' => 'Success',
            'data' => $data
        ], 200);
    }

    // get all role
    public function AllRole()
    {
        $data = Role::all();

        return response()->json([
            'status' => 'Success',
            'data' => $data
        ], 200);
    }

    // add role 
    public function AddRole(Request $request)
    {

        $data = Role::create($request->all());

        return response()->json([
            'status' => 'Success',
            'data' => $data
        ], 200);
    }

    // role update
    public  function updateRole(Request $request, $id)
    {

        $data = Role::findOrFail($id);
        $data->update($request->all());

        return response()->json([
            'status' => 'Success',
            'data' => $data
        ], 200);
    }


    public function showRole($id)
    {
        $data = Permission::findOrFail($id);

        return response()->json([
            'status' => 'Success',
            'data' => $data
        ], 200);
    }
    // role data delete
    public function Delete($id)
    {

        $data = Role::findOrFail($id);
        $data->delete();

        return response()->json([
            'status' => 'Success',
            'data' => $data
        ], 200);
    }


    public function AddRolesPermission()
    {

        $roles = Role::all();
        $permission = Permission::all();
        $permission_group = User::getPergetPermissionGroup();
    }
}
