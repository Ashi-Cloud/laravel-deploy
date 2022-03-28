<?php

namespace App\Services\Deploy\DeploymentTasks;

use App\Services\Deploy\DeployApplication;

abstract class Task
{
    protected $host;
    protected $project;
    protected $deployPath;
    protected $cwd;
    protected $branch;
    protected $repository;

    protected const STATUS_RUNNING = 'Task Running:';
    protected const STATUS_LOG = 'Task Log';
    protected const STATUS_ERRORED = 'Task ERROR: ';
    protected const STATUS_COMPLETED = 'Task Completed: ';

    public function __construct(DeployApplication $deployApplication)
    {
        $this->host = $deployApplication->host;
        $this->project = $deployApplication->project;
        $this->deployPath = $deployApplication->deployPath;
        $this->branch = $deployApplication->branch;
        $this->repository = $deployApplication->repository;
    }

    abstract public function run();

    abstract public function getTaskName(): string ;
    
    abstract public function getTaskDescription(): string ;

    public function addStatusLog($status, $message= null)
    {
        if ( $status === self::STATUS_LOG ){
            $this->project->appendLog("{$status} : {$message} ");
        }

        if ( $status !== self::STATUS_LOG ){
            $this->project->addFormatedLog("{$status} : {$this->getTaskName()} {$message} ");
        }

        return $this;
    }
}
