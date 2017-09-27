<?php

namespace App\Http\Controllers;

use App\WorkingTicket;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Http\Traits\SlugTrait;

class WorkingTicketController extends Controller
{
    use SlugTrait;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        $working_tickets = Auth::user()->working_tickets()->with('users', 'author', 'working_times')->get();
        $users = User::all();
        //return $working_tickets;
        return view('sites.working_tickets.working_tickets', compact([
           'working_tickets',
           'users'
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
        $data = $this->validate($request, [
            'name' => 'required',
            'markup' => 'required',
            'html' => 'required'
        ]);

        $slugs = WorkingTicket::pluck('slug')->toArray();

        WorkingTicket::create([
            'name' => $data['name'],
            'slug' => $this->generateUniqueSlug($request['name'], $slugs),
            'user_id' => Auth::user()->id,
            'markup' => $data['description'],
            'html' => $data['html'],
        ])->users()->save(Auth::user());

        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\WorkinTicket  $workinTicket
     * @return \Illuminate\Http\Response
     */
    public function show(WorkingTicket $workingTicket)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\WorkinTicket  $workinTicket
     * @return \Illuminate\Http\Response
     */
    public function edit(WorkingTicket $workingTicket)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\WorkinTicket  $workinTicket
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, WorkingTicket $workingTicket)
    {
        //
    }

    public function update_description(Request $request, WorkingTicket $workingTicket)
    {
        $workingTicket->update([
            'description' => $request->description
        ]);
        return response()->json(['status' => 'Beschreibung wurde bearbeitet', 'type' => 'success'], 200);
    }

    public function update_status(Request $request, WorkingTicket $workingTicket)
    {
        $workingTicket->update([
            'completed' => $request->completed
        ]);
        return response()->json(['status' => 'Status wurde aktualisiert', 'type' => 'success'], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\WorkinTicket  $workinTicket
     * @return \Illuminate\Http\Response
     */
    public function destroy(WorkingTicket $workingTicket)
    {
        //
    }

    public function add_user(Request $request, WorkingTicket $workingTicket)
    {
        $workingTicket->users()->save(User::find($request->user_id));
        return response()->json(['status' => 'Benutzer wurde hinzugefügt', 'type' => 'success'], 200);
    }

    public function remove_user(Request $request, WorkingTicket $workingTicket)
    {
        if($workingTicket->author->id == $request->user_id){
            return response()->json(['status' => 'Der Author kann nicht gelöscht werden.', 'type' => 'danger']);
        }

        $workingTicket->users()->detach($request->user_id);
        return response()->json(['status' => 'Der Nutzer wurde entfernt', 'type' => 'success']);
    }
}
