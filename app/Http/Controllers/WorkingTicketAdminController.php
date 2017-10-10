<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\WorkingTicket;
use App\Http\Traits\SlugTrait;
use App\User;
class WorkingTicketAdminController extends Controller
{
    use SlugTrait;
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string|max:255',
            'author' => 'required',
            'users' => 'nullable'
        ]);

        $slugs = WorkingTicket::pluck('slug')->toArray();

        $working_ticket = WorkingTicket::create([
            'name' => $data['name'],
            'slug' => $this->generateUniqueSlug($data['name'], $slugs),
            'user_id' => $data['author']['id'],
            'markup' => $data['description'],
            'html' => $data['description'],
        ]);

        $working_ticket->users()->save(User::find($data['author']['id']));

        array_map(function($user) use($working_ticket){
                $working_ticket->users()->save(User::find($user['id']));
        }, $data['users']);

        return response()->json(['message' => 'Wurde hinzugefügt.', 'type' => 'success']);
    }
}
