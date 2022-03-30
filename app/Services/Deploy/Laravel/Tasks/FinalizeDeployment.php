<?php

namespace App\Services\Deploy\Laravel\Tasks;

use App\Services\Deploy\DeploymentTasks\Task;

class FinalizeDeployment extends Task
{
    public function run()
    {
        $this->addStatusLog(self::STATUS_RUNNING);
        
        $currentRelease = trim($this->host->runCommand("cat {$this->deployPath}/.dep/latest_release"),"\n");
        $releasePath = "{$this->deployPath}/releases/{$currentRelease}";
        $currentPath = "{$this->deployPath}/current";

        if ( $this->host->test("[ -h {$currentPath} ]") ){
            $this->host->test("rm {$currentPath} ");
        }

        $this->host->runCommand("ln -s $releasePath {$currentPath} ");

        $this->addStatusLog(self::STATUS_COMPLETED);
    }

    public function getTaskName(): string
    {
        return 'Publish Deployment';
    }

    public function getTaskDescription(): string
    {
        return '';
    }
}
