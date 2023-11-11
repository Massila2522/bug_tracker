<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Ticket;
use App\Models\User;
use Auth;
use Illuminate\Http\Request;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index(): View
    {
        $userId = Auth::id();
        $allUserTickets = Ticket::whereHas('devs', function ($query) use ($userId) {
            $query->where('user_id', $userId);
        })->count();

        $projects = Project::with('projectAuthor')->paginate(3);

        $issueTickets = ((Ticket::whereHas('devs', function ($query) use ($userId) {
            $query->where('user_id', $userId);
        })->where('type', 'value1')->count()) / $allUserTickets) * 100;

        $bugTickets = ((Ticket::whereHas('devs', function ($query) use ($userId) {
            $query->where('user_id', $userId);
        })->where('type', 'value2')->count()) / $allUserTickets) * 100;

        $featureTickets = ((Ticket::whereHas('devs', function ($query) use ($userId) {
            $query->where('user_id', $userId);
        })->where('type', 'value3')->count()) / $allUserTickets) * 100;


        $immediateTickets = ((Ticket::whereHas('devs', function ($query) use ($userId) {
            $query->where('user_id', $userId);
        })->where('priority', 'value1')->count()) / $allUserTickets) * 100;

        $highTickets = ((Ticket::whereHas('devs', function ($query) use ($userId) {
            $query->where('user_id', $userId);
        })->where('priority', 'value2')->count()) / $allUserTickets) * 100;

        $lowTickets = ((Ticket::whereHas('devs', function ($query) use ($userId) {
            $query->where('user_id', $userId);
        })->where('priority', 'value3')->count()) / $allUserTickets) * 100;

        $mediumTickets = ((Ticket::whereHas('devs', function ($query) use ($userId) {
            $query->where('user_id', $userId);
        })->where('priority', 'value4')->count()) / $allUserTickets) * 100;


        $resolvedTickets = ((Ticket::whereHas('devs', function ($query) use ($userId) {
            $query->where('user_id', $userId);
        })->where('status', 'value1')->count()) / $allUserTickets) * 100;

        $newTickets = ((Ticket::whereHas('devs', function ($query) use ($userId) {
            $query->where('user_id', $userId);
        })->where('status', 'value2')->count()) / $allUserTickets) * 100;

        $inProgressTickets = ((Ticket::whereHas('devs', function ($query) use ($userId) {
            $query->where('user_id', $userId);
        })->where('status', 'value3')->count()) / $allUserTickets) * 100;

        $users = User::all();

        return view('dashboard', [
            'projects' => $projects,
            'issueTickets' => $issueTickets,
            'bugTickets' => $bugTickets,
            'featureTickets' => $featureTickets,
            'immediateTickets' => $immediateTickets,
            'highTickets' => $highTickets,
            'lowTickets' => $lowTickets,
            'mediumTickets' => $mediumTickets,
            'resolvedTickets' => $resolvedTickets,
            'newTickets' => $newTickets,
            'inProgressTickets' => $inProgressTickets,
            'users' => $users
        ]);
    }

    public function searchProjects()
    {
        $search_text = $_GET['query'];
        $tickets = Ticket::with('ticketAuthor')->get();
        $users = User::all();
        if($search_text != ''){
            $projects = Project::where('name','LIKE','%'.$search_text.'%')
                        ->orWhere('description','LIKE','%'.$search_text.'%')
                        ->with('projectAuthor')
                        ->paginate(3);

            return view('dashboard', [
                'projects' => $projects,
                'tickets' => $tickets,
                'users' => $users
            ]);
        } else{
            return redirect('dashboard');
        }


    }

}
