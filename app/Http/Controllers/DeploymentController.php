<?php

namespace App\Http\Controllers;

use App\Models\Project;

class DeploymentController
{
    public function __invoke(Project $project)
    {
        return view('projects.deployments', compact('project'));
    }
}
