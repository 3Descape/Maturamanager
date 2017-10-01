<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\CleanUpPerson;

class CleanUpPersonController extends Controller
{
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
