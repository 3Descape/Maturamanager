<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\WorkingTime;

class NavigationController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function home()
    {
        $mostRecentWorkingTimes = WorkingTime::mostRecent()->with('user')->get();
        return view('sites.home', compact([
            'mostRecentWorkingTimes'
        ]));
    }
}
