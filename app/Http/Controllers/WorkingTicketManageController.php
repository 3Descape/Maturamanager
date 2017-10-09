<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\WorkignTicket;

class WorkingTicketManageController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('sites.working_tickets.working_tickets_manage');
    }
}
