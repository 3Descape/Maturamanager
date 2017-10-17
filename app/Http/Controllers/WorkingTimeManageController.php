<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\WorkingTime;
class WorkingTimeManageController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $this->authorize('working_time', auth()->user());
        $unconfirmed = WorkingTime::unconfirmed()->with('user', 'working_ticket')->orderBy('created_at', 'desc')->get();
        return view('sites.working_times.working_time_manage', compact([
            'unconfirmed'
        ]));
    }

    public function update(WorkingTime $workingTime)
    {
        $this->authorize('working_time', auth()->user());
        $workingTime->update([
            'confirmed' => !$workingTime->confirmed
        ]);

        return response()->json(['status' => 'success'], 200);
    }
}
