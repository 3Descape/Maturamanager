<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\WorkingTime;
use App\CleanUpPerson;
use Carbon\Carbon;

class NavigationController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function home()
    {
        $mostRecentWorkingTimes = WorkingTime::mostRecent()->with('user')->get();
        $cleanUps = CleanUpPerson::where('date', "<=", Carbon::now()->addDays(7))->with('user')->get();
        return view('sites.home', compact([
            'mostRecentWorkingTimes',
            'cleanUps'
        ]));
    }
}
