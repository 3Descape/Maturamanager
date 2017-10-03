<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Role;
use App\Permission;
class RolesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $roles = Role::with('permissions')->get();
        $permissions = Permission::all();

        return view('sites.roles.roles_index', compact([
            'roles',
            'permissions'
        ]));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|unique:roles,name',
            'label' => 'required|string'
        ]);

        Role::create($data);
        return back();
    }

    public function delete(Role $role)
    {
        $role->delete();
        return back();
    }
    public function store_permission(Request $request, Role $role)
    {
        $role->addPermission(Permission::find($request->permission));
        return back();
    }

    public function remove_permission(Role $role, $permission_id)
    {
        $role->removePermission($permission_id);
        return back();
    }
}
