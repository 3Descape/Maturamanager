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
        $this->authorize('superadmin', auth()->user());
        $roles = Role::with('permissions')->get();
        $permissions = Permission::all();

        return view('sites.roles.roles_index', compact([
            'roles',
            'permissions'
        ]));
    }

    public function store(Request $request)
    {
        $this->authorize('superadmin', auth()->user());
        $data = $request->validate([
            'name' => 'required|string|unique:roles,name',
            'label' => 'required|string'
        ]);

        Role::create($data);
        return back();
    }

    public function delete(Role $role)
    {
        $this->authorize('superadmin', auth()->user());
        $role->delete();
        return back();
    }
    public function store_permission(Request $request, Role $role)
    {
        $this->authorize('superadmin', auth()->user());
        $role->addPermission(Permission::find($request->permission));
        return back();
    }

    public function remove_permission(Role $role, $permission_id)
    {
        $this->authorize('superadmin', auth()->user());
        $role->removePermission($permission_id);
        return back();
    }
}
