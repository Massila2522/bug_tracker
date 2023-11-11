<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProjectRequest;
use App\Models\Project;
use App\Models\Ticket;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\MessageBag;

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

        if ($project->errors) {
            session()->flash('showEditProjectModal', true);
        }

        return redirect()->route('dashboard')->with('success','Project updated');
    }

    public function destroy(Project $project)
    {
        $project->delete();

        return redirect()->route('dashboard')->with('success','Project Deleted');
    }

    public function show(Project $project)
    {
        $users = User::all();
        $usersNotInProject = User::whereDoesntHave('assignedProjects', function ($query) use ($project) {
            $query->where('project_id', $project->id);
        })->get();

        return view('project.show_project', [
            'project' => $project,
            'usersNotInProject' => $usersNotInProject,
            'users' => $users
        ]);
    }

    public function addMember(Request $request, Project $project)
    {
        $project->members()->attach($request->users);

        return back()->with('success','Members Added successfuly!');
    }

    public function removeMember(Project $project, User $member)
    {
        $project->members()->detach($member);

        return back()->with('success','Member removed successfuly!');
    }

}
