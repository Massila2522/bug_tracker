<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProjectRequest;
use App\Models\Project;
use App\Models\Ticket;
use App\Models\User;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function save(ProjectRequest $request)
    {
        $validated = $request->validated();
        $project = Project::create($validated);
        $project->members()->attach($request->members);

        return redirect()->route('dashboard')->with('success','Project Added');
    }

    public function update(ProjectRequest $request, Project $project)
    {
        $project->update($request->validated());
        $project->members()->sync($request->members);

        return redirect()->route('dashboard')->with('success','Project updated');
    }

    public function destroy(Project $project)
    {
        $project->delete();

        return redirect()->route('dashboard')->with('success','Project Deleted');
    }

    public function show(Project $project)
    {
        $tickets = Ticket::where('project_id', '$project->id')->paginate(1);
        $users = User::all();

        return view('project.show_project', [
            'project' => $project,
            'tickets' => $tickets,
            'users' => $users
        ]);
    }

}
