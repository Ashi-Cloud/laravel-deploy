<?php

namespace App\Http\Controllers;

use App\Models\Server;
use App\Models\Project;
use App\Http\Requests\Projects\ProjectUpdateRequest;

class ProjectController
{
    public function __construct()
    {
        view()->composer([
            'projects.create',
            'projects.edit'
        ],function($view){
            $servers = Server::query()->get(['id','name']);
            $view->with('servers',$servers);
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
        return view('projects.create', [
            'project' => new Project()
        ]);
    }

    public function store(ProjectUpdateRequest $projectUpdateRequest)
    {
        Project::create(
            $projectUpdateRequest->validated()
        );

        session()->flash('alert-success','Project Created Succesfully');
        return to_route('projects.index');
    }

    public function edit(Project $project)
    {
        return view('projects.edit', compact('project'));
    }

    public function update(ProjectUpdateRequest $projectUpdateRequest, Project $project)
    {
        $project->update(
            $projectUpdateRequest->validated()
        );

        session()->flash('alert-success','Project Updated Succesfully');
        return to_route('projects.index');
    }

    public function show(Project $project)
    {
        return view('projects.show', compact('project'));
    }

    public function destroy(Project $project)
    {
        $project->delete();
        session()->flash('alert-success','Project Deleted Succesfully');
        return to_route('projects.index');
    }
}
