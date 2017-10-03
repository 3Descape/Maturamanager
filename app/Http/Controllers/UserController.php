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
        $user = $user->with('working_times', 'working_times.working_ticket')->first();
        //return $user;
        return view('sites.user.user_show', compact(
            'user'
        ));
    }

}
