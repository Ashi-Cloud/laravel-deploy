<?php

namespace App\Http\Controllers;

use App\Models\Server;
use App\Models\Project;
use App\Http\Requests\Projects\BasicInfoRequest;

class ProjectController
{
    public function __construct()
    {
        view()->composer([
            'projects.create',
            'projects.edit'
        ], function ($view) {
            $servers = Server::query()->get(['id', 'name']);
            $view->with('servers', $servers);
            return $view;
        });
    }

    public function index()
    {
        $projects = Project::query()->withLastDeployed()->paginate(50);
        return view('projects.index', compact('projects'));
    }

    public function create()
    {
        return view('projects.create');
    }

    public function store(BasicInfoRequest $request)
    {
        $project = Project::create(
            $request->validated()
        );

        return to_route('projects.edit', $project->id)->with('alert-success', 'Project Created Succesfully');
    }

    public function edit(Project $project)
    {
        return view('projects.edit', compact('project'));
    }

    public function update(BasicInfoRequest $request, Project $project)
    {
        $project->update(
            $request->validated()
        );

        return back()->with('alert-success', 'Project Updated Succesfully');
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
