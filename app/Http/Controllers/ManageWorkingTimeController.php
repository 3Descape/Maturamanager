<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\WorkingTime;
class ManageWorkingTimeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $unconfirmed = WorkingTime::unconfirmed()->with('user', 'working_ticket')->get();
        return view('sites.working_times.working_time_manage', compact([
            'unconfirmed'
        ]));
    }

    public function update(WorkingTime $workingTime)
    {
        $workingTime->update([
            'confirmed' => !$workingTime->confirmed
        ]);

        return response()->json(['status' => 'success'], 200);
    }
}
