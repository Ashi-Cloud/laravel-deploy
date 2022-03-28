<?php

namespace App\Services\Deploy\Laravel\Tasks;

use Exception;
use App\Services\Deploy\DeploymentTasks\Task;

class PrepareDeployment extends Task
{
    public function run()
    {
        $this->addStatusLog(self::STATUS_RUNNING);

        $newReleaseName = "release_".now()->format('YmdHis');

        if ( $this->host->test("[ -f {$this->deployPath}/release.lock ]") ){
            throw new Exception("A Deployment is already in-progress.");
        }

        $this->host->runCommand("echo {$newReleaseName} > {$this->deployPath}/.dep/release.lock");

        $this->host->runCommand("mkdir {$this->deployPath}/releases/{$newReleaseName}");
        
        $this->addStatusLog(self::STATUS_COMPLETED);
    }

    public function getTaskName(): string
    {
        return 'Prepare for deployment';
    }

    public function getTaskDescription(): string
    {
        return '';
    }
}
