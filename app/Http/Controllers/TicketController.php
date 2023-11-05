<?php

namespace App\Http\Controllers;

use App\Http\Requests\TicketRequest;
use App\Models\Comment;
use App\Models\Ticket;
use Illuminate\Http\Request;

class TicketController extends Controller
{
    public function save(TicketRequest $request)
    {
        $validated = $request->validated();
        $ticket = Ticket::create($validated);
        $ticket->devs()->attach($request->devs);

        return back()->with('success','Ticket Added successfully!');
    }

    public function update(TicketRequest $request, Ticket $ticket)
    {
        $ticket->update($request->validated());
        $ticket->devs()->sync($request->devs);

        return back()->with('success','Project updated successfully!');
    }

    public function destroy(Ticket $ticket)
    {
        $ticket->delete();

        return back()->with('success','Project Deleted successfully!');
    }

    public function show(Ticket $ticket)
    {
        $comments = Comment::where('ticket_id', '$ticket->id')->get();

        return view('ticket.show_ticket', [
            'ticket' => $ticket,
            'comments' => $comments
        ]);
    }
}
