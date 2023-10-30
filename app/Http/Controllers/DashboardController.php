<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Ticket;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index(): View
    {

        $projects = Project::with('projectAuthor')->paginate(3);
        $tickets = Ticket::with('ticketAuthor')->get();
        $users = User::all();

        return view('dashboard', [
            'projects' => $projects,
            'tickets' => $tickets,
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
