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

    public function is_admin(User $user)
    {
        return $user->hasRole('admin');
    }

    public function can_manage_working_time(User $user)
    {
        return $user->hasPermission('can_confirm_working_time');
    }
}
