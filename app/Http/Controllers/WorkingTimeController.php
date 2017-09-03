<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\WorkingTime;
use App\User;
use Illuminate\Http\Request;

class WorkingTimeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $working_tickets = Auth::user()->working_tickets()->get();

        $working_times = Auth::user()->working_times()->with('working_ticket')->get();

        return view('sites.working_times.working_times', compact([
            'working_tickets',
            'working_times'
        ]));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $data = $this->validate($request,[
            'working_time' => 'required|integer|min:2',
            'description' => 'string|nullable',
            'working_ticket' => 'sometimes|nullable|integer|exists:working_tickets,id'
        ]);

        WorkingTime::create([
            'description' => $data['description'],
            'working_time' => $data['working_time'],
            'user_id' => Auth::user()->id,
            'working_ticket_id' => $data['working_ticket'],
        ]);

        return back();

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\WorkingTime  $workingTime
     * @return \Illuminate\Http\Response
     */
    public function show(WorkingTime $workingTime)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\WorkingTime  $workingTime
     * @return \Illuminate\Http\Response
     */
    public function edit(WorkingTime $workingTime)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\WorkingTime  $workingTime
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, WorkingTime $workingTime)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\WorkingTime  $workingTime
     * @return \Illuminate\Http\Response
     */
    public function destroy(WorkingTime $workingTime)
    {
        //
    }
}
