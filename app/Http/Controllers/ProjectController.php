<?php

namespace App\Http\Controllers;

use App\Models\Server;
use App\Models\Project;

class ProjectController
{
    public function index()
    {
        $projects = Project::query()->withLastDeployed()->paginate(50);
        return view('projects.index', compact('projects'));
    }

    public function create()
    {
        return view('projects.create');
    }

    public function edit(Project $project)
    {
        return view('projects.edit', compact('project'));
    }

    public function show(Project $project)
    {
        return view('projects.show', compact('project'));
    }

    public function destroy(Project $project)
    {
        $project->delete();
        return to_route('projects.index')->with('alert-success', 'Project Deleted Succesfully');
    }
}
