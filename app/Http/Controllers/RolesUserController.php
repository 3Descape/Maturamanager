<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Role;

class RolesUserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function edit($user_slug)
    {
        $this->authorize('superadmin', auth()->user());
        $user = User::getBySlug($user_slug)->with('roles')->first();
        $roles = Role::where('name', "!=", "superadmin")->get()->diff($user->roles);
        return view('sites.user_roles.user_edit_roles', compact([
            'user',
            'roles'
        ]));
    }

    public function store(Request $request, User $user)
    {
        $this->authorize('superadmin', auth()->user());
        $user->assignRole(Role::find($request->role));
        return back();
    }

    public function delete(User $user, $role_id)
    {
        $this->authorize('superadmin', auth()->user());
        $user->removeRole($role_id);
        return back();
    }
}
