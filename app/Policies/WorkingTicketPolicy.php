<?php

namespace App\Policies;

use App\User;
use App\WorkingTicket;
use Illuminate\Auth\Access\HandlesAuthorization;

class WorkingTicketPolicy
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

    public function add_user(User $user, WorkingTicket $working_ticket)
    {
        return $user->id === $working_ticket->author->id;
    }
}
