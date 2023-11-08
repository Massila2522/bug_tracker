<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use Auth;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class AllTicketsController extends Controller
{
    public function index(): View
    {
        $userId = Auth::id();
        $tickets = Ticket::whereHas('devs', function ($query) use ($userId) {
            $query->where('user_id', $userId);
        })->paginate(5);

        return view('tickets', [
            'tickets' => $tickets
        ]);
    }
}
