<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Hash;
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

    public function settings()
    {
        return view('sites.users.settings');
    }

    public function update(Request $request, User $user)
    {
        $request->validate([
            'password_old' => [
                "required",
                new \App\Rules\PasswordIsValidRule($user)
            ],
            'password' => 'required|confirmed|min:4',
            'password_confirmation' => 'required'


        ],[
            'password_old.required' => 'Das alte Passwort muss angegeben werden.',
            'password_confirmation.required' => 'Du musst das neue Passwort bestädigen.',
        ]);

        $user->update([
            'password' => bcrypt($request->password)
        ]);

        session(['message' => 'Wurde aktualisiert.']);
        return back();
    }

}
