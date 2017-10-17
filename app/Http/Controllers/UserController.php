<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Hash;
class UserController extends Controller
{
    public function index()
    {
        $this->authorize('user', auth()->user());
        $users = User::with('roles')->orderBy('name')->get();
        return view('sites.users.user_index', compact([
            "users"
        ]));
    }
    public function show($user_slug)
    {
        $user = User::getBySlug($user_slug)->with(['working_times' => function($query){
            $query->where('confirmed', 1)->orderBy('created_at', 'desc');
        }, 'working_times.working_ticket'])->first();
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
