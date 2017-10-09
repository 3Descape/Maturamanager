<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\CleanUpPerson;
use Carbon\Carbon;

class CleanUpPersonController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $this->authorize('cleanup_person', auth()->user());
        $duty_past = CleanUpPerson::where('date', '<=', Carbon::now())->with('user')->get()->take(10);
        return view('sites.cleanUpPeople.cleanUpPeople', compact([
            'duty_past'
        ]));
    }

    public function store(Request $request)
    {
        $new = CleanUpPerson::create([
            'date' => $request->date,
            'user_id' => $request->user_id
        ]);
        \Log::info($new->id);
        $date = CleanUpPerson::where('id', '=', $new->id)->with('user')->first();

        return response()->json(['message' => 'Wurde eingetragen.', 'type' => 'success', 'data' => $date], 200);
    }
}
