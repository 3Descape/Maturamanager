<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class UserController extends Controller
{
    public function index()
    {
        $users = User::with('roles')->get();
        return view('sites.users.user_index', compact([
            "users"
        ]));
    }
    public function show(User $user)
    {
        // TODO: add some profile view in here
        dd($user);
        return $user;
    }

}
