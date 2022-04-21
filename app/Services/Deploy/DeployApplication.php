<?php

namespace App\Services\Deploy;

use Closure;
use App\Models\Project;
use Illuminate\Support\Str;
use App\Services\Deploy\Host\DeployHost;

abstract class DeployApplication
{
    public $host;
    public $project;
    public $deployPath;
    public $branch;
    public $repository;
    public $projectName;

    protected $tasks = [];

    public function __construct(Project $project, Closure $output)
    {
        $this->project = $project;
        $this->projectName = $project->deploy_directory_name;
        $this->deployPath = $project->deploy_path;
        $this->repository = $project->git_repository;
        $this->branch = $project->git_branch;
        
        $this->host = DeployHost::createFromProject($project, $output);
    }

    public function deploy()
    {
        $this->runTasks();
    }


    protected function runTasks()
    {
        foreach ($this->tasks as $task) {
            (new $task($this))->run();
        }
    }
}
