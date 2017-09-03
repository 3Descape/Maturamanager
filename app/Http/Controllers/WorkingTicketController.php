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
        $working_tickets = Auth::user()->working_tickets()->with('users', 'author')->get();
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
            'description' => 'required',
        ]);

        $slugs = WorkingTicket::pluck('slug')->toArray();

        WorkingTicket::create([
            'name' => $data['name'],
            'slug' => $this->generateUniqueSlug($request['name'], $slugs),
            'user_id' => Auth::user()->id,
            'description' => $data['description'],
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
        return back();
    }

    public function remove_user(WorkingTicket $workingTicket, User $user)
    {
        if($workingTicket->author->id== $user->id){
            return back();
        }
        
        $workingTicket->users()->detach($user->id);
        return back();
    }
}
