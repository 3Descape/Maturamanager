<?php

namespace App\Policies;

use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class RolesPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function before(User $user)
    {
        if($user->hasRole('superadmin')){
            return true;
        }
    }

    public function admin(User $user)
    {
        return $user->hasRole('admin');
    }

    public function superadmin(User $user)
    {
        return $user->hasRole('superadmin');
    }

    public function working_time(User $user)
    {
        return $user->hasPermission('working_time');
    }

    public function cleanup_person(User $user)
    {
        return $user->hasPermission('cleanupPerson') || $user->hasPermission('admin');
    }

    public function user(User $user)
    {
        return $user->hasPermission('user');
    }
}
